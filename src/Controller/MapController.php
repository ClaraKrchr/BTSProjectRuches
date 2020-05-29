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
        
        $RucheRucher=$this->getDoctrine()->getRepository(AssociationRucheRucher::class)->findBy(array('ruche'=>$Ruches));        
        $MesuresStations=$this->getDoctrine()->getRepository(MesuresStations::class)->findBy(array('rucher'=>$RucheRucher));

        $MesuresRuches=$this->getDoctrine()->getRepository(MesuresRuches::class)->findBy(array('ruche'=>$Ruches));
        
        $dateinstall= $this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche))->getDateInstall();
        
       
        //------------Recherche des ruches appartenant a l'utilisateur connecté-------------//
        $RuchesApiculteurs = $this->getDoctrine()->getRepository(AssociationRucheApiculteur::class)->findBy(array('apiculteur'=>$NomProprietaire));
        $RuchesPublic =  $this->getDoctrine()->getRepository(CRuche::class)->findBy(array('visibilite'=>'0'));
        return $this->render('Ruches/info_ruche.html.twig',[
            'nomruche'=>$nomruche,'proprietaire'=>$NomProprietaire,'dateinstall'=>$dateinstall,
            'mesuresstations'=>$MesuresStations,'mesuresruches'=>$MesuresRuches,
            'ruchepubliques'=>$RuchesPublic,
            'rucheprivees'=>$RuchesApiculteurs
        ]);
    }    
    
    //---Passe toutes les mesures de la ruche sous format json---//
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/mesures_ruche_diagramme/{nomruche}", name="mesures_ruche_diagramme")
     * 
     * @param $nomruche
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function mesures_ruche_diagramme($nomruche):
        Response
        {       
        $Ruches=$this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche));
        $MesuresRuches=$this->getDoctrine()->getRepository(MesuresRuches::class)->findBy(array('ruche'=>$Ruches));
        $stock[]='';
        foreach ($MesuresRuches as $MesuresRuche){
            
            $stock[] = array(
                            $MesuresRuche->getDateReleve(),
                            $MesuresRuche->getPoids()
                        );
        }
        return $this->json($stock, 200);
        }
        
}