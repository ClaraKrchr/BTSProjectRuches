<?php

namespace App\Controller;

use App\Entity\CRucher;
use App\Entity\CRuche;
use App\Entity\AssociationRucheRucher;
use App\Entity\AssociationRucherRegion;
use App\Entity\Regions;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\CRucheRepository;

use App\Form\RuchesPubliquesFormType;

class RuchesPubliquesController extends AbstractController{
    /**
     * @Route("/ruches/publiques/{regions}/{page}", name="ruches_publiques", defaults={"page"=1})
     */
    public function new(EntityManagerInterface $em, $regions, PaginatorInterface $paginator, Request $request, $page)   {
        
        $region = $this->getDoctrine()->getRepository(Regions::class)->findBy(array('nomregion'=>$regions));
        $RucherRegion = $this->getDoctrine()->getRepository(AssociationRucherRegion::class)->findBy(array('region'=>$region));
        $AssosRucheRucher = $this->getDoctrine()->getRepository(AssociationRucheRucher::class)->findBy(array('rucher'=>$RucherRegion));
        $ARRLength = count($AssosRucheRucher);
        $j = 0;
        for($i = 0; $i < $ARRLength; $i++)
        {
            if ($AssosRucheRucher[$i]->getRuche()->getVisibilite() == '0'){
                $ruches[$j] = $AssosRucheRucher[$i]->getRuche();
                $j++;
            }
        }
        $form = $this->createForm(\App\Form\RuchesPubliquesFormType::class);
        
        
        $paginations = $paginator->paginate(
            $ruches,
            $page,
            6
            );  
        return $this->render('Ruches/ruches_publiques.html.twig',
            ['filterForm' => $form->createView(),
                'paginations' => $paginations,
                'region' => $regions
            ]);
    }
}