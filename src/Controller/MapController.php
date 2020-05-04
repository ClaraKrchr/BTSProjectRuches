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

class MapController extends NouvellepageController{
    
    /*Les routes des régions*/
    
    
    /**
     * @Route("/tableau_donnees/{regions}",name="tableau_donnees")
     */
    public function tableau_donnees($regions)
    {
        $NomProprietaire=$this->getUser();
        $ruchers = $this->getDoctrine()->getRepository(CRucher::class)->findBy(array('region'=>$regions));
        $peseruches = $this->getDoctrine()->getRepository(CPeseRuche::class)->findBy(array('rucher'=>$ruchers,'proprietaire'=>$NomProprietaire));
               
        
         return $this->render('map/tableau_donnees.html.twig', ['peseruches' => $peseruches,]);
    }
    
    /*Les fonctions*/
    
    
}