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
     * @Route("/ruches/publiques/{regions}/{ruche}/{proprietaire}/{page}", name="ruches_publiques", defaults={"page"=1})
     */
    public function new(EntityManagerInterface $em, $regions, PaginatorInterface $paginator, Request $request, $page, $ruche, $proprietaire)   {
        
        $region = $this->getDoctrine()->getRepository(Regions::class)->findBy(array('nomregion'=>$regions));
        $RucherRegion = $this->getDoctrine()->getRepository(AssociationRucherRegion::class)->findBy(array('region'=>$region));
        $AssosRucheRucher = $this->getDoctrine()->getRepository(AssociationRucheRucher::class)->findBy(array('rucher'=>$RucherRegion));
        $ARRLength = count($AssosRucheRucher);
        $ruches = array();
        for($j = $i = 0; $i < $ARRLength; $i++)
        {
            if ($AssosRucheRucher[$i]->getRuche()->getVisibilite() == '0'){
                if($ruche == 'NULL'){ //ruche pas précisée
                    if ($proprietaire == 'NULL'){ //propriétaire et ruche pas précisés
                        $ruches[$j] = $AssosRucheRucher[$i]->getRuche();
                        $j++;
                    }
                    else if ($AssosRucheRucher[$i]->getRuche()->getAssociationRucheApiculteur()->getApiculteur()->getPseudo() == $proprietaire){ //propriétaire précisé mais pas ruche
                        $ruches[$j] = $AssosRucheRucher[$i]->getRuche();
                        $j++;
                    }
                }
                else if($proprietaire == 'NULL'){ //ruche précisée mais pas propriétaire
                    if ($AssosRucheRucher[$i]->getRuche()->getNomruche() == $ruche){
                        $ruches[$j] = $AssosRucheRucher[$i]->getRuche();
                        $j++;
                    }
                }
                else{
                    if (($AssosRucheRucher[$i]->getRuche()->getNomruche() == $ruche) && ($AssosRucheRucher[$i]->getRuche()->getAssociationRucheApiculteur()->getApiculteur()->getPseudo() == $proprietaire)){
                        $ruches[$j] = $AssosRucheRucher[$i]->getRuche();
                        $j++;
                    }
                }
            }
        }
        $form = $this->createForm(\App\Form\RuchesPubliquesFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if ($data['Proprietaire'] == NULL) {
                if ($data['Nom_ruche'] == NULL) return ($this->redirectToRoute('ruches_publiques', array('regions' => $regions, 'ruche' => 'NULL', 'proprietaire' => 'NULL'))); //Ni proprio ni ruche
                return ($this->redirectToRoute('ruches_publiques', array('regions' => $regions, 'ruche' => $data['Nom_ruche'], 'proprietaire' => 'NULL'))); //Ruche mais pas proprio
            }
            if ($data['Nom_ruche'] == NULL) return ($this->redirectToRoute('ruches_publiques', array('regions' => $regions, 'ruche' => 'NULL', 'proprietaire' => $data['Proprietaire']->getPseudo()))); //Proprio mais pas ruche
            return ($this->redirectToRoute('ruches_publiques', array('regions' => $regions, 'ruche' => $data['Nom_ruche'], 'proprietaire' => $data['Proprietaire']->getPseudo()))); //Proprio et ruche
        }
        
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