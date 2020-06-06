<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\CRuche;
use App\Entity\CRucher;
use App\Entity\AssociationRucheRucher;
use App\Entity\AssociationRucheApiculteur;
use App\Entity\MesuresStations;
use App\Entity\MesuresRuches;
use App\Entity\AssociationRucherRegion;
use App\Entity\Regions;
use function Symfony\Component\DependencyInjection\Exception\__toString;
use App\Entity\CApiculteur;

use Doctrine\ORM\EntityRepository;

class MapController extends NouvellepageController{
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/tableau_donnees/{regions}",name="tableau_donnees")
     */
    public function tableau_donnees($regions)
    {
        
        //--------Obtention du nom ce l'utilisateur----------------//
        $NomProprietaire=$this->getUser();
        //-------------Recherche des ruchers dans la region---------------//
        $Regions=$this->getDoctrine()->getRepository(Regions::class)->findBy(array('nomregion'=>$regions));
        $RucherRegion = $this->getDoctrine()->getRepository(AssociationRucherRegion::class)->findBy(array('region'=>$Regions));
        //-------------Recherche des ruches dans les ruchers-----------------//
        $RuchesRuchers= $this->getDoctrine()->getRepository(AssociationRucheRucher::class)->findBy(array('rucher'=>$RucherRegion));
        //------------Recherche des ruches appartenant a l'utilisateur connecté-------------//
        $RuchesApiculteurs = $this->getDoctrine()->getRepository(AssociationRucheApiculteur::class)->findBy(array('ruche'=>$RuchesRuchers,'apiculteur'=>$NomProprietaire));
        
        return $this->render('Ruches/tableau_donnees.html.twig', ['apiculteurs' => $RuchesApiculteurs,'region'=>$regions]);
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/info_ruche/{nomruche}", name="info_ruche")
     */
    public function info_ruche($nomruche,EntityManagerInterface $em, Request $request){
        
        $NomProprietaire=$this->getUser();
        
        $Ruches=$this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche));
        
        $RucheRucher=$this->getDoctrine()->getRepository(AssociationRucheRucher::class)->findOneBy(array('ruche'=>$nomruche));
        $qb = $em->createQueryBuilder();
        $qb->select('w')->from(MesuresStations::class, 'w')->where('w.station = ' . $RucheRucher->getId())->orderBy('w.date_releve', 'ASC');
        $query = $qb->getQuery();
        $MesuresStations=$this->getResult();
        
        $qb = $em->createQueryBuilder();
        $qb->select('w')->from(MesuresRuches::class, 'w')->where('w.ruche = ' . $Ruches->getId())->orderBy('w.date_releve', 'ASC');
        $query = $qb->getQuery();
        $MesuresRuches = $query->getResult();
        
        $dateinstall= $this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche))->getDateInstall();
        
        //------------Recherche des ruches appartenant a l'utilisateur connecté-------------//
       
        return $this->render('Ruches/info_ruche.html.twig',[
            'nomruche'=>$nomruche,'proprietaire'=>$NomProprietaire,'dateinstall'=>$dateinstall,
            'mesuresstations'=>$MesuresStations,'mesuresruches'=>$MesuresRuches,
        ]);
    }
    
    //---Passe toutes les mesures de la ruche sous format json---//
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/mesures_ruche_diagramme/{nomruche}/{nomruche2}", name="mesures_ruche_diagramme")
     *
     * @param $nomruche
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function mesures_ruche_diagramme($nomruche,$nomruche2, EntityManagerInterface $em):Response
    {
        $stock=[];
        if($nomruche!='NULL'){
            if($nomruche2!='NULL'){
                $Ruches=$this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche));
                $qb = $em->createQueryBuilder();
                $qb->select('w')->from(MesuresRuches::class, 'w')->where('w.ruche = ' . $Ruches->getId())->orderBy('w.date_releve', 'ASC');
                $query = $qb->getQuery();
                $MesuresRuches = $query->getResult();
                if($MesuresRuches){
                    foreach ($MesuresRuches as $MesuresRuche){
                        
                        $stockage1[] = array(
                            $MesuresRuche->getDateReleve(),
                            $MesuresRuche->getPoids()
                        );
                    }
                }
                $Ruches2=$this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche2));
                $qb = $em->createQueryBuilder();
                $qb->select('w')->from(MesuresRuches::class, 'w')->where('w.ruche = ' . $Ruches2->getId())->orderBy('w.date_releve', 'ASC');
                $query = $qb->getQuery();
                $MesuresDeRuches = $query->getResult();
                if($MesuresDeRuches){
                    foreach ($MesuresDeRuches as $MesuresDeRuche){
                        
                        $stockage2[]= array(
                            $MesuresDeRuche->getDateReleve(),
                            $MesuresDeRuche->getPoids()
                        );
                    }
                }
                $stock[]=$stockage1;
                $stock[]=$stockage2;
            }else{
                $Ruches=$this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche));
                if($Ruches){
                $qb = $em->createQueryBuilder();
                $qb->select('w')->from(MesuresRuches::class, 'w')->where('w.ruche = ' . $Ruches->getId())->orderBy('w.date_releve', 'ASC');
                $query = $qb->getQuery();
                $MesuresRuches = $query->getResult();
                
                foreach ($MesuresRuches as $MesuresRuche){
                    
                    $stock[] = array(
                        $MesuresRuche->getDateReleve()->getTimestamp(),
                        $MesuresRuche->getPoids()
                    );
                }
                return $this->json($stock, 200);
                }
                return $this->json($stock, 200);;
            }
            
            return $this->json($stock, 200);
        }
        return $this->json($stock, 200);;
    }
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/ruches_desactivees", name="ruches_desactivees")
     */
    public function ruches_desactivees(EntityManagerInterface $em, Request $request){
        
        $NomProprietaire=$this->getUser();
        
        $AssosRucheApi = $this->getDoctrine()->getRepository(AssociationRucheApiculteur::class)->findBy(array('apiculteur'=>$NomProprietaire));

        $qb = $em->createQueryBuilder();
        $qb->select('w')->from(CRuche::class, 'w')->where('w.etat = 4')->orderBy('w.datearchive', 'ASC');
        $query = $qb->getQuery();
        $sendRuches = $query->getResult();
        
        return $this->render('Ruches/ruches_desactivees.html.twig', ['ruches' => $sendRuches]);
    }  
    
    /**
     * @Route("/details_ruches/{nomruche}", name="details_ruches")
     */
    public function details_ruches($nomruche,EntityManagerInterface $em, Request $request){
        
        $NomProprietaire=$this->getUser();
        
        $RuchesApiculteurs = $this->getDoctrine()->getRepository(AssociationRucheApiculteur::class)->findBy(array('apiculteur'=>$NomProprietaire));
        $RuchesPublic =  $this->getDoctrine()->getRepository(CRuche::class)->findBy(array('visibilite'=>'0'));
        
        return $this->render('Ruches/detail_ruche.html.twig',['nomruche'=>$nomruche,'ruchepubliques'=>$RuchesPublic,'rucheprivees'=>$RuchesApiculteurs]);
    }
}