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
    
    /**
     * @Route("/bretagne", name="bretagne")
     */
    public function bretagne()
    {
        return $this->render('map/bretagne.html.twig');
    }
    
    /**
     * @Route("/normandie", name="normandie")
     */
    public function normandie()
    {
        return $this->render('map/normandie.html.twig');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * @Route("/pese_ruche", name="create_pese_ruche")
     */
    public function createPeseRuche(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();
        

        $proprietaire = $entityManager->getRepository(CApiculteur::class)->find(18);
        $rucher = $entityManager->getRepository(CRucher::class)->find(1);
        
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