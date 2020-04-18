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
     * @Route("/corse", name="corse")
     */
    public function corse()
    {
        return $this->render('map/corse.html.twig');
    }
    
    /**
     * @Route("/occitanie", name="occitanie")
     */
    public function occitanie()
    {
        return $this->render('map/occitanie.html.twig');
    }
    
    /**
     * @Route("/nouvelle_aquitaine", name="nouvelle_aquitaine")
     */
    public function nouvelle_aquitaine()
    {
        return $this->render('map/nouvelle_aquitaine.html.twig');
    }
    
    /**
     * @Route("/provence_alpes_cote_dazur", name="provence_alpes_cote_dazur")
     */
    public function provence_alpes_cote_dazur()
    {
        return $this->render('map/provence_alpes_cote_dazur.html.twig');
    }
    
    /**
     * @Route("/ile_de_france", name="ile_de_france")
     */
    public function ile_de_france()
    {
        return $this->render('map/ile_de_france.html.twig');
    }
    
    /**
     * @Route("/pays_de_la_loire", name="pays_de_la_loire")
     */
    public function pays_de_la_loire()
    {
        return $this->render('map/pays_de_la_loire.html.twig');
    }
    
    /**
     * @Route("/grand_est", name="grand_est")
     */
    public function grand_est()
    {
        return $this->render('map/grand_est.html.twig');
    }
    
    /**
     * @Route("/hauts_de_france", name="hauts_de_france")
     */
    public function hauts_de_france()
    {
        return $this->render('map/hauts_de_france.html.twig');
    }
    
    /**
     * @Route("/auvergne_rhone_alpes", name="auvergne_rhone_alpes")
     */
    public function auvergne_rhone_alpes()
    {
        return $this->render('map/auvergne_rhone_alpes.html.twig');
    }
    
    /**
     * @Route("/centre_val_de_loire", name="centre_val_de_loire")
     */
    public function centre_val_de_loire()
    {
        return $this->render('map/centre_val_de_loire.html.twig');
    }
    
    /**
     * @Route("/bourgogne_franche_comte", name="bourgogne_franche_comte")
     */
    public function bourgogne_franche_comte()
    {
        return $this->render('map/bourgogne_franche_comte.html.twig');
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