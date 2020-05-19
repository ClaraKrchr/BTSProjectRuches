<?php

namespace App\Controller;

use App\Entity\CRucher;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CarnetRepository;

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
        return $this->render('Ruches/ruches_privees.html.twig');
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/googleMap", name="googleMap")
     */
    public function googleMap(){
        $ruchers = $this->getDoctrine()->getRepository(CRucher::class)->findAll();
        return $this->render('map/googleMap.html.twig', ['ruchers' => $ruchers,]);
    }
    /**
     * @Route("/change_locale/{locale}", name="change_locale")
     */
    public function changeLocale($locale, Request $request){
        // on stocke la langue demandée dans la session
        $request->getSession()->Set('_locale',$locale);
        
        // on reviens sur la page précédente
        return $this->redirect($request->headers->get('referer'));
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/carnet", name="carnet")
     */
    public function carnet(CarnetRepository $carnet){
        return $this->render('Ruches/carnet.html.twig' , [
            'carnet' => $carnet->findAll()
        ]);
    }
    
}
    
        
        
        
        