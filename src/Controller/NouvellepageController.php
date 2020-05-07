<?php

namespace App\Controller;

use App\Entity\CApiculteur;
use App\Entity\CRucher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
     * @IsGranted("ROLE_USER")
     * @Route("/ruches_privees", name="ruches_privees")
     */
    public function ruches_privees()
    {
        return $this->render('nouvellepage/ruches_privees.html.twig');
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/googleMap", name="googleMap")
     */
    public function googleMap(){
        $message=utf8_encode('Pour ajouter un rucher, récupérez les coordonnées en cliquant sur la carte puis copiez-les et cliquer sur le bouton "Ajouter un rucher"');
        $ruchers = $this->getDoctrine()->getRepository(CRucher::class)->findAll();
        $this->addFlash('messageGoogleMap',$message);
        return $this->render('map/googleMap.html.twig', ['ruchers' => $ruchers,]);
    }
    
    /**
     * @Route("/info_ruche/{nomruche}", name="info_ruche")
     */
    public function info_ruche($nomruche){
        
        return $this->render('map/info_ruche.html.twig',['nomruche'=>$nomruche,]);
    }
}