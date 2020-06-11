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
use App\Entity\AssociationRuchePeseruche;
use App\Entity\AssociationRucheRucher;
use App\Entity\AssociationRucheApiculteur;
use App\Entity\AssociationPeserucheStation;
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
        
        $RuchePeseruche=$this->getDoctrine()->getRepository(AssociationRuchePeseruche::class)->findOneBy(array('ruche'=>$nomruche));
        if ($RuchePeseruche != NULL){
            $PeserucheStation = $this->getDoctrine()->getRepository(AssociationPeserucheStation::class)->findOneBy(array('peseruche'=>$RuchePeseruche->getPeseruche()));
            $Station = $PeserucheStation->getStation();
            $qb = $em->createQueryBuilder();
            $qb->select('w')->from(MesuresStations::class, 'w')->where('w.station = ' . $Station)->orderBy('w.date_releve', 'ASC');
            $query = $qb->getQuery();
            $MesuresStations=$this->getResult();
        }
        else{
            $MesuresStations = NULL;
        }
        
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
                            $MesuresRuche->getDateReleve()->getTimestamp()*1000,
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
                            $MesuresDeRuche->getDateReleve()->getTimestamp()*1000,
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
                        $MesuresRuche->getDateReleve()->getTimestamp()*1000,
                         $MesuresRuche->getPoids()
                    );
                }                
                return new Response(json_encode($stock));
                }
                return new Response(json_encode($stock));
            }
            
            return new Response(json_encode($stock));
        }
        return new Response(json_encode($stock));
    }
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/ruches_desactivees", name="ruches_desactivees")
     */
    public function ruches_desactivees(EntityManagerInterface $em, Request $request){
                
        $qb = $em->createQueryBuilder();
        $qb->select('w')->from(CRuche::class, 'w')->where('w.etat = 4')->orderBy('w.datearchive', 'ASC');
        $query = $qb->getQuery();
        $sendRuches = $query->getResult();
        
        return $this->render('Ruches/ruches_desactivees.html.twig', ['ruches' => $sendRuches]);
    }  
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/details_ruches/{nomruche}", name="details_ruches")
     */
    public function details_ruches($nomruche,EntityManagerInterface $em, Request $request){
        
        $NomProprietaire=$this->getUser();
        
        $RuchesApiculteurs = $this->getDoctrine()->getRepository(AssociationRucheApiculteur::class)->findBy(array('apiculteur'=>$NomProprietaire));
        $RuchesPublic =  $this->getDoctrine()->getRepository(CRuche::class)->findBy(array('visibilite'=>'0'));
        
        return $this->render('Ruches/detail_ruche.html.twig',['nomruche'=>$nomruche,'proprietaire'=>$NomProprietaire,'ruchepubliques'=>$RuchesPublic,'rucheprivees'=>$RuchesApiculteurs]);
    }
}