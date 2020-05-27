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
     * @Route("/ruches/publiques/{regions}/{ruche}/{proprietaire}/{type}/{page}", name="ruches_publiques", defaults={"page"=1})
     */
    public function new(EntityManagerInterface $em, $regions, PaginatorInterface $paginator, Request $request, $page, $ruche, $proprietaire, $type)   {
        
        $region = $this->getDoctrine()->getRepository(Regions::class)->findBy(array('nomregion'=>$regions));
        $RucherRegion = $this->getDoctrine()->getRepository(AssociationRucherRegion::class)->findBy(array('region'=>$region));
        $AssosRucheRucher = $this->getDoctrine()->getRepository(AssociationRucheRucher::class)->findBy(array('rucher'=>$RucherRegion));
        $ARRLength = count($AssosRucheRucher);
        $ruches = array();
        for($j = $i = 0; $i < $ARRLength; $i++)
        {
            if ($AssosRucheRucher[$i]->getRuche()->getVisibilite() == '0'){
                if($ruche == 'NULL'){ //Ruche X
                    if ($proprietaire == 'NULL'){ //Propio X
                        if ($type == 'NULL'){ //Type X
                            $ruches[$j] = $AssosRucheRucher[$i]->getRuche();
                            $j++;
                                    //Ruche X proprio X type X
                        } //Type OK
                        else if ($AssosRucheRucher[$i]->getRuche()->getTyperuche() == $type){
                            $ruches[$j] = $AssosRucheRucher[$i]->getRuche();
                            $j++;
                                    //Ruche X proprio X type OK
                        }
                    } //Proprio OK
                    else{
                        if ($type == 'NULL'){ //Type X
                            if ($AssosRucheRucher[$i]->getRuche()->getAssociationRucheApiculteur()->getApiculteur()->getPseudo() == $proprietaire){
                                $ruches[$j] = $AssosRucheRucher[$i]->getRuche();
                                $j++;
                                    //Ruche X proprio OK type X
                            }
                        } //Type OK
                        else if (($AssosRucheRucher[$i]->getRuche()->getAssociationRucheApiculteur()->getApiculteur()->getPseudo() == $proprietaire) && ($AssosRucheRucher[$i]->getRuche()->getTyperuche() == $type))
                        $ruches[$j] = $AssosRucheRucher[$i]->getRuche();
                        $j++;
                                    //Ruche X proprio OK type OK
                    }
                } //Ruche OK
                else if($proprietaire == 'NULL'){ //Proprio X
                    if ($type == 'NULL'){ //Type X
                        if ($AssosRucheRucher[$i]->getRuche()->getNomruche() == $ruche){
                            $ruches[$j] = $AssosRucheRucher[$i]->getRuche();
                            $j++;
                                    //Ruche OK proprio X type X
                        }
                    } //Type OK
                    else if (($AssosRucheRucher[$i]->getRuche()->getNomruche() == $ruche) && ($AssosRucheRucher[$i]->getRuche()->getTyperuche() == $type)){
                        $ruches[$j] = $AssosRucheRucher[$i]->getRuche();
                        $j++;
                                    //Ruche OK proprio X type OK
                    }
                } //Proprio OK
                else{
                    if ($type == 'NULL'){ //Type X
                        if (($AssosRucheRucher[$i]->getRuche()->getNomruche() == $ruche) && ($AssosRucheRucher[$i]->getRuche()->getAssociationRucheApiculteur()->getApiculteur()->getPseudo() == $proprietaire)){
                            $ruches[$j] = $AssosRucheRucher[$i]->getRuche();
                            $j++;
                                    //Ruche OK proprio OK type X
                        }
                    } //Type OK
                    else if (($AssosRucheRucher[$i]->getRuche()->getNomruche() == $ruche) && ($AssosRucheRucher[$i]->getRuche()->getAssociationRucheApiculteur()->getApiculteur()->getPseudo() == $proprietaire) && ($AssosRucheRucher[$i]->getRuche()->getTyperuche() == $type)){
                        $ruches[$j] = $AssosRucheRucher[$i]->getRuche();
                        $j++;
                                    //Ruche OK proprio OK type OK
                    }
                }
            }
        }
        $form = $this->createForm(\App\Form\RuchesPubliquesFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if ($data['Proprietaire'] == NULL) { //Propriétaire X 
                if ($data['Nom_ruche'] == NULL) { //Ruche X 
                    if ($data['Type'] == NULL) return ($this->redirectToRoute('ruches_publiques', array('regions' => $regions, 'ruche' => 'NULL', 'proprietaire' => 'NULL', 'type' => 'NULL'))); 
                    //Proprio X ruche X type X
                    return ($this->redirectToRoute('ruches_publiques', array('regions' => $regions, 'ruche' => 'NULL', 'proprietaire' => 'NULL', 'type' => $data['Type']))); 
                    //Proprio X ruche X type OK
                } //Ruche OK
                if ($data['Type'] == 'NULL') return ($this->redirectToRoute('ruches_publiques', array('regions' => $regions, 'ruche' => $data['Nom_ruche'], 'proprietaire' => 'NULL', 'type' => 'NULL')));
                    //Proprio X ruche OK type X
                return ($this->redirectToRoute('ruches_publiques', array('regions' => $regions, 'ruche' => $data['Nom_ruche'], 'proprietaire' => 'NULL', 'type' => data['Type']))); 
                    //Proprio X ruche OK type OK
            } //Propriétaire OK
            if ($data['Nom_ruche'] == NULL) { //Ruche X
                if ($data['Type'] == NULL) return ($this->redirectToRoute('ruches_publiques', array('regions' => $regions, 'ruche' => 'NULL', 'proprietaire' => $data['Proprietaire']->getPseudo(), 'type' => 'NULL'))); 
                    //Proprio OK ruche X type X
                return ($this->redirectToRoute('ruches_publiques', array('regions' => $regions, 'ruche' => 'NULL', 'proprietaire' => $data['Proprietaire']->getPseudo(), 'type' => $data['Type'])));
                    //Proprio OK ruche X type OK
            } //Ruche OK
            if ($data['Type' == 'NULL']) return ($this->redirectToRoute('ruches_publiques', array('regions' => $regions, 'ruche' => $data['Nom_ruche'], 'proprietaire' => $data['Proprietaire']->getPseudo(), 'type' => 'NULL')));
                    //Proprio OK ruche OK type X
            return ($this->redirectToRoute('ruches_publiques', array('regions' => $regions, 'ruche' => $data['Nom_ruche'], 'proprietaire' => $data['Proprietaire']->getPseudo(), 'type' => $data['Type']))); 
                    //Proprio OK ruche OK type OK
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