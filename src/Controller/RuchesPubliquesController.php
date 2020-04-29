<?php

namespace App\Controller;

use App\Entity\CPeseRuche;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Form\RuchesPubliquesFormType;
use App\Repository\CPeseRucheRepository;

class RuchesPubliquesController extends AbstractController
{
    /**
     * @Route("/ruches/publiques", name="ruches_publiques")
     */
    public function new(EntityManagerInterface $em)   {
        
        $pubPeseRuches = $this->getDoctrine()->getRepository(CPeseRuche::class)->findBy(array('visibilite'=>1));
        
        $form = $this->createForm(\App\Form\RuchesPubliquesFormType::class);
        return $this->render('ruches_publiques/new.html.twig',
            ['filterForm' => $form->createView(),'pubPeseRuches' =>$pubPeseRuches,
            ]);
    }
}