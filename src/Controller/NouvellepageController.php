<?php

namespace App\Controller;

use App\Entity\CApiculteur;
use App\Entity\CRucher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class NouvellepageController extends AbstractController
{
    
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('base.html.twig');
    }
    
    
    /**
     * @Route("/ruches_privees", name="ruches_privees")
     */
    public function ruches_privees()
    {
        return $this->render('nouvellepage/ruches_privees.html.twig');
    }
    
    /**
     * @Route("/gestionnaire_apiculteurs", name="gestionnaire_apiculteurs")   
     */
    public function gestionnaire_apiculteurs()
    {
        $apiculteurs = $this->getDoctrine()->getRepository(CApiculteur::class)->findAll();
        
        return $this->render('nouvellepage/gestionnaire_apiculteurs.html.twig', ['apiculteurs' => $apiculteurs,]);
    }
   
    /**
     * @Route("/ruches_publiques", name="ruches_publiques")
     */
    public function ruches_publiques()
    {
        return $this->render('nouvellepage/ruches_publiques.html.twig');
    }
    
    /**
     * @Route("/googleMap", name="googleMap")
     */
    public function googleMap(){
        $ruchers = $this->getDoctrine()->getRepository(CRucher::class)->findAll();
        $this->addFlash('messageGoogleMap','Pour ajouter un rucher, recuperez les coordonnees en cliquant sur la carte puis copiez-les et cliquer sur le bouton "Ajouter un rucher"');
        return $this->render('map/googleMap.html.twig', ['ruchers' => $ruchers,]);
    }
    
}