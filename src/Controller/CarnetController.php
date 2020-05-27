<?php

namespace App\Controller;

use App\Entity\Carnet;
use App\Repository\CarnetRepository;

use App\Form\CarnetFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class CarnetController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/carnet", name="carnet")
     */
    public function carnet(Request $request){
        $form = $this->createForm(CarnetFormType::class);
        $form->handleRequest($request);
        
        return $this->render('Ruches/carnet.html.twig' , [
        'carnetForm' => $form->createView()
        ]);
    }
    
    /**
     * @IsGRanted("ROLE_USER")
     * @Route("/carnet/{ruche}/{page}", name="carnet_ruche", defaults={"page"=1})
     */
    public function carnetRuche(Request $request, PaginatorInterface $paginator){
        $donnees = $this->getDoctrine()->getRepository(Carnet::class)->findAll();
        
        $carnet = $paginator->paginate(
            $donnees, 
            $request->query->getIn('page', 1), 
            30);
        
        return $this->render('Ruches/carnet.html.twig', [
            'carnets' => $carnet, ]
        );
    }
}