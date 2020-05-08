<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\CPeseRuche;
use App\Form\AddPeseRucheFormType;

class AddPeseRucheController extends AbstractController
{
    /**
     * @Route("/add_pese_ruche", name="add_pese_ruche")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $CPeseRuche = new CPeseRuche();
        $form = $this->createForm(AddPeseRucheFormType::class, $CPeseRuche);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($CPeseRuche);
            $em->flush();
        }
        
        
        return $this->render('add_pese_ruche/add.html.twig', [
            'addPeseRucheForm' => $form->createView(),
        ]);
    }
}
