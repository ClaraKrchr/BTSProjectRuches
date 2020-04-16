<?php

namespace App\Controller;

use App\Entity\CApiculteur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class NouvellepageController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('base.html.twig');
    }
    
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('base.html.twig');
    }
    
    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();
        
        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        
        return $this->render('nouvellepage/connexion.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
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
     * @Route("/carte", name="carte")
     */
    public function carte()
    {
        return $this->render('map/map.html.twig');
    }
    
    /**
     * @Route("/ruches_publiques", name="ruches_publiques")
     */
    public function ruches_publiques()
    {
        return $this->render('nouvellepage/ruches_publiques.html.twig');
    }
    
}