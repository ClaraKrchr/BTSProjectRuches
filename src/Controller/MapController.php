<?php

namespace App\Controller;

use App\Entity\CPeseRuche;
use App\Entity\CApiculteur;
use App\Entity\CRucher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\CRuche;

class MapController extends NouvellepageController{
        
    /**
     * @Route("/tableau_donnees/{regions}",name="tableau_donnees")
     */
    public function tableau_donnees($regions)
    {
        $NomProprietaire=$this->getUser();
        $ruchers = $this->getDoctrine()->getRepository(CRucher::class)->findBy(array('region'=>$regions));
        $ruches = $this->getDoctrine()->getRepository(CRuche::class)->findBy(array('rucher'=>$ruchers,'proprietaire'=>$NomProprietaire));
               
        return $this->render('map/tableau_donnees.html.twig', ['ruches' => $ruches,'region'=>$regions]);
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