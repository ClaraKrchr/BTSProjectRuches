<?php

namespace App\Controller;

use App\Entity\CPeseRuche;
use App\Entity\CApiculteur;
use App\Entity\CRucher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class MapController extends NouvellepageController{
    
    /**
     * @Route("/carte", name="carte")
     */
    public function carte()
    {
        return $this->render('map/map.html.twig');
    }
    
    
    /*Les routes des régions*/
    
    
    /**
     * @Route("/tableau_donnees",name="tableau_donnees")
     */
    public function tableau_donnees(/*$regions*/)
    {
        $peseruches = $this->getDoctrine()->getRepository(CPeseRuche::class)->findAll();
     
        return $this->render('map/tableau_donnees.html.twig', ['peseruches' => $peseruches,]);
    }
    
    /*Les fonctions*/
    
    
    /**
     * @Route("/pese_ruche", name="create_pese_ruche")
     */
    public function createPeseRuche(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();
        

        $proprietaire = $entityManager->getRepository(CApiculteur::class)->find(18);
        $rucher = $entityManager->getRepository(CRucher::class)->find(5);
        
        $PeseRuche = new CPeseRuche();
        $PeseRuche->setNomPeseRuche('RucheTest1');
        $PeseRuche->setPoids('30');
        $PeseRuche->setHumiditeInter('20');
        $PeseRuche->setHumiditeExter('60');
        $PeseRuche->setTempInter('19');
        $PeseRuche->setTempExter('23');
        $PeseRuche->setLuminosite('36');
        $PeseRuche->setNivEau('0.6');
        $PeseRuche->setProprietaire($proprietaire);
        $PeseRuche->setRucher($rucher);
        $PeseRuche->setTypeRuche('2');
        $PeseRuche->setVisibilite('1');
        
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($PeseRuche);
        
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        
        return new Response('Saved new pese ruche with id '.$PeseRuche->getId());
    }
    
}