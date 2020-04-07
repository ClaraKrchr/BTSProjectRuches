<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class NouvellepageController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        return $this->render('nouvellepage/index.html.twig');
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
     * @Route("/inscription", name="inscription")
     */
    public function inscription()
    {
        return $this->render('nouvellepage/inscription.html.twig');
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
        return $this->render('nouvellepage/gestionnaire_apiculteurs.html.twig');
    }
    /**
     * @Route("/ajoutruche", name="ajoutruche")
     */
    public function ajoutruche()
    {
        return $this->render('nouvellepage/ajoutruche.html.twig');
    }
    /**
     * @Route("/carte", name="carte")
     */
    public function carte()
    {
        return $this->render('nouvellepage/map.html.twig');
    }
    
    /**
     * @Route("/ruches_publiques", name="ruches_publiques")
     */
    public function ruches_publiques()
    {
        return $this->render('nouvellepage/ruches_publiques.html.twig');
    }
    
}