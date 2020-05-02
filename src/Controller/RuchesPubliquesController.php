<?php

namespace App\Controller;

use App\Entity\CPeseRuche;
use App\Entity\CRucher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Form\RuchesPubliquesFormType;
use App\Repository\CPeseRucheRepository;

class RuchesPubliquesController extends AbstractController{
    /**
     * @Route("/ruches/publiques/{regions}", name="ruches_publiques")
     */
    public function new(EntityManagerInterface $em ,$regions)   {
        
        $ruchers = $this->getDoctrine()->getRepository(CRucher::class)->findBy(array('region'=>$regions));
        $pubPeseRuches = $this->getDoctrine()->getRepository(CPeseRuche::class)->findBy(array('rucher'=>$ruchers,'visibilite'=>0));
        $form = $this->createForm(\App\Form\RuchesPubliquesFormType::class);
        return $this->render('ruches_publiques/ruches_publiques.html.twig',
            ['filterForm' => $form->createView(),'pubPeseRuches' =>$pubPeseRuches,
            ]);
    }
}