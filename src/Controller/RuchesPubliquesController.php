<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Form\RuchesPubliquesFormType;

class RuchesPubliquesController extends AbstractController
{
    /**
     * @Route("/ruches/publiques", name="ruches_publiques")
     */
    public function new(EntityManagerInterface $em)   {
        
        //die('Todo!');
        $form = $this->createForm(RuchesPubliquesFormType::class);
        return $this->render('ruches_publiques/new.html.twig',
            ['filterForm' => $form->createView(),
            ]);
    }
}
