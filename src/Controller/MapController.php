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
        $Ruchers = $this->getDoctrine()->getRepository(CRucher::class)->findBy(array('region'=>$regions));
        //-------------Recherche des ruches dans les ruchers-----------------//
        $RuchesRuchers= $this->getDoctrine()->getRepository(AssociationRucheRucher::class)->findBy(array('rucher'=>$Ruchers));
        //------------Recherche des ruches appartenant a l'utilisateur connecté-------------//
        $RuchesApiculteurs = $this->getDoctrine()->getRepository(AssociationRucheApiculteur::class)->findBy(array('ruche'=>$RuchesRuchers,'apiculteur'=>$NomProprietaire));
       
        return $this->render('map/tableau_donnees.html.twig', ['apiculteurs' => $RuchesApiculteurs,'region'=>$regions]);
    }
    
    /**
     * @Route("/info_ruche/{nomruche}", name="info_ruche")
     */
    public function info_ruche($nomruche){
        
        $NomProprietaire=$this->getUser();
        $dateinstall= $this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche))->getDateInstall();
        return $this->render('map/info_ruche.html.twig',['nomruche'=>$nomruche,'proprietaire'=>$NomProprietaire,'dateinstall'=>$dateinstall,]);
    }        
}