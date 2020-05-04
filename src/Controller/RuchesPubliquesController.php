<?php

namespace App\Controller;

use App\Entity\CPeseRuche;
use App\Entity\CRucher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

use App\Form\RuchesPubliquesFormType;
use App\Repository\CPeseRucheRepository;

class RuchesPubliquesController extends AbstractController{
    /**
     * @Route("/ruches/publiques/{regions}/{page}", name="ruches_publiques", defaults={"page"=1})
     */
    public function new(EntityManagerInterface $em, CPeseRucheRepository $repository, $regions, PaginatorInterface $paginator, Request $request, $page)   {
        
        $ruchers = $this->getDoctrine()->getRepository(CRucher::class)->findBy(array('region'=>$regions));
        $paginations = $paginator->paginate(
            $repository->findBy(array('rucher'=>$ruchers,'visibilite'=>0)),
            $page,
            6
            );
        
        //$pubPeseRuches = $this->getDoctrine()->getRepository(CPeseRuche::class)->findBy(array('rucher'=>$ruchers,'visibilite'=>0));
        $form = $this->createForm(\App\Form\RuchesPubliquesFormType::class);
        return $this->render('ruches_publiques/ruches_publiques.html.twig',
            ['filterForm' => $form->createView(),
                //'pubPeseRuches' =>$pubPeseRuches,
                'paginations' => $paginations
            ]);
    }
}