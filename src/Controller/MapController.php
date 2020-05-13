<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


use App\Entity\CRuche;
use App\Entity\CRucher;
use App\Entity\AssociationRucheRucher;
use App\Entity\AssociationRucheApiculteur; 
use App\Entity\MesuresStations;
use App\Entity\MesuresRuches;
use App\Entity\AssociationRucherRegion;
use App\Entity\Regions;

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
    public function info_ruche($nomruche){
        
        $NomProprietaire=$this->getUser();
        $Rucher=$this->getDoctrine()->getRepository(AssociationRucheRucher::class)->findBy(array('ruche'=>$nomruche));
        $MesuresStations=$this->getDoctrine()->getRepository(MesuresStations::class)->findBy(array('rucher'=>$Rucher));
        $Ruches=$this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche));
        $MesuresRuches=$this->getDoctrine()->getRepository(MesuresRuches::class)->findBy(array('ruche'=>$Ruches));
        $dateinstall= $this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche))->getDateInstall();
        return $this->render('Ruches/info_ruche.html.twig',[
            'nomruche'=>$nomruche,'proprietaire'=>$NomProprietaire,'dateinstall'=>$dateinstall,'mesuresstations'=>$MesuresStations,'mesuresruches'=>$MesuresRuches]);
    }        
}