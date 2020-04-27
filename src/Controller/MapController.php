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
    
    /**
     * @Route("/carte", name="carte")
     */
    public function carte()
    {
        return $this->render('map/map.html.twig');
    }
    
    
    /*Les routes des régions*/
    
    
    /**
     * @Route("/tableau_donnees/{region}",name="tableau_donnees")
     */
    public function tableau_donnees($regions)
    {
        $peseruches = $this->getDoctrine()->getRepository(CPeseRuche::class)->find($regions);
     
        return $this->render('map/tableau_donnees.html.twig', ['peseruches' => $peseruches,]);
    }
    
    /*Les fonctions*/
    
    
}