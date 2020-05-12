<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Entity\CApiculteur;
use App\Entity\CRuche;
use App\Entity\CPeseRuche;
use App\Entity\CRucher;
use App\Entity\CStation;
use App\Entity\AssociationRucheApiculteur;
use App\Entity\AssociationRuchePeseruche;
use App\Entity\AssociationRucheRucher;
use App\Entity\AssociationPeserucheStation;
use App\Entity\AssociationStationRucher;
use App\Entity\Regions;

use App\Form\AddRucheFormType;
use App\Form\AddPeseRucheFormType;
use App\Form\AddStationFormType;
use App\Form\AddRucherFormType;
use App\Form\RegionsFormType;

class AddController extends AbstractController{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/add_ruche", name="add_ruche")
     */
    public function add_ruche(EntityManagerInterface $em, Request $request) {
        $form = $this->createForm(AddRucheFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $CRuche = new CRuche();
            
            $NomApiculteur=$this->getUser();
            
            $apiculteur = $em->getRepository(CApiculteur::class)->findOneBy(array('id'=>$NomApiculteur));
            
            $CRuche->setNomruche($data['Nom_ruche']);
            $CRuche->setDateinstall($data['Date_installation']);
            $CRuche->setVisibilite($data['Visibilite']);
            $CRuche->setTyperuche($data['Type_ruche']);
            $CRuche->setEtat($data['Etat']);
            
            $em->persist($CRuche);
            
            
            $AssociationRucheApiculteur = new AssociationRucheApiculteur();
            
            $AssociationRucheApiculteur->setRuche($CRuche);
            $AssociationRucheApiculteur->setApiculteur($apiculteur);
            $em->persist($AssociationRucheApiculteur);
            $apiculteur->addAssociationRucheApiculteur($AssociationRucheApiculteur);
            $CRuche->setAssociationRucheApiculteur($AssociationRucheApiculteur);
            
            if($data['Rucher'] != NULL){
                $AssociationRucheRucher = new AssociationRucheRucher();
                
                $AssociationRucheRucher->setRuche($CRuche);
                $AssociationRucheRucher->setRucher($em->getRepository(CRucher::class)->findOneBy(array('id'=>($data['Rucher'])->getId())));
                $em->persist($AssociationRucheRucher);
                ($data['Rucher'])->addAssociationRucheRucher($AssociationRucheRucher);
                $CRuche->setAssociationRucheRucher($AssociationRucheRucher);
            }
            
            if($data['PeseRuche'] != NULL){
                $AssociationRuchePeseruche = new AssociationRuchePeseruche();
                
                $AssociationRuchePeseruche->setRuche($CRuche);
                $AssociationRuchePeseruche->setPeseruche($em->getRepository(CPeseRuche::class)->findOneBy(array('id'=>($data['PeseRuche'])->getId())));
                $em->persist($AssociationRuchePeseruche);
                ($data['PeseRuche'])->setAssociationRuchePeseruche($AssociationRuchePeseruche);
                $CRuche->setAssociationRuchePeseruche($AssociationRuchePeseruche);
            }
            
            $em->flush();
            
            $message=utf8_encode('La ruche a été ajoutée');
            $this->addFlash('message',$message);
            
            return $this->redirectToRoute('add_ruche');
        }
        
        
        
        return $this->render('Add/add_ruche.html.twig', [
            'addRucheForm' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/add_pese_ruche", name="add_pese_ruche")
     */
    public function add_pese_ruche(EntityManagerInterface $em, Request $request)
    {
        
        
        $form = $this->createForm(AddPeseRucheFormType::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            
            $CPeseRuche = new CPeseRuche();
            $CPeseRuche->setNomPeseRuche($data['nompeseruche']);
            $CPeseRuche->setDateInstall($data['dateinstall']);
            $CPeseRuche->setVisibilite($data['visibilite']);
            
            $em->persist($CPeseRuche);
            
            $associationPeserucheStation = new AssociationPeserucheStation();
            
            $associationPeserucheStation->setPeseruche($CPeseRuche);
            $associationPeserucheStation->setStation($em->getRepository(CStation::class)->findOneBy(array('id'=>($data['nomstation'])->getId())));
            $em->persist($associationPeserucheStation);
            ($data['nomstation'])->addAssociationPeserucheStation($associationPeserucheStation);
            
            $CPeseRuche->setAssociationPeserucheStation($associationPeserucheStation);
            $em->flush();
            
            $message=utf8_encode('Le pèse ruche a été ajouté');
            $this->addFlash('message',$message);
            
            return $this->redirectToRoute('add_pese_ruche');
        }
        
        
        return $this->render('Add/add_pese_ruche.html.twig', [
            'addPeseRucheForm' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/add_station", name="add_station")
     */
    public function add_station(EntityManagerInterface $em, Request $request) {
        $form = $this->createForm(AddStationFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            $CStation = new CStation();
            $CStation->setNom($data['Nom_station']);
            $CStation->setDateinstall($data['Date_installation']);
            
            $em->persist($CStation);
            
            $AssociationStationRucher = new AssociationStationRucher();
            
            $AssociationStationRucher->setStation($CStation);
            $AssociationStationRucher->setRucher($em->getRepository(CRucher::class)->findOneBy(array('id'=>($data['Rucher'])->getId())));
            $em->persist($AssociationStationRucher);
            ($data['Rucher'])->addAssociationStationRucher($AssociationStationRucher);
            $CStation->setAssociationStationRucher($AssociationStationRucher);
            $em->flush();
            
            $message=utf8_encode('La station a été ajoutée');
            $this->addFlash('station',$message);
            
            return $this->redirectToRoute('add_station');
        }
        
        
        
        return $this->render('Add/add_station.html.twig', [
            'addStationForm' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/add_rucher/{latitude}/{longitude}/{region}", name="add_rucher")
     */
    public function add_rucher($latitude, $longitude, $region, EntityManagerInterface $em, Request $request) {
        $form = $this->createForm(AddRucherFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $CRucher = new CRucher();
            
            $CRucher->setRegion($region);
            $CRucher->setLatitude($latitude);
            $CRucher->setLongitude($longitude);
            $CRucher->setNom($data['Nom']);
            
            $em->persist($CRucher);
            $em->flush();
            
            $message=utf8_encode('Le rucher a été ajouté');
            $this->addFlash('success',$message);
            
            return ($this->redirectToRoute('googleMap'));( $this->addFlash('Notification','Changement effectué'));
        }
        
        $ruchers = $this->getDoctrine()->getRepository(CRucher::class)->findAll();
        
        
        return $this->render('Add/add_rucher.html.twig', [
            'addrucherform' => $form->createView(),'ruchers' =>$ruchers,
        ]);
    }
    
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/add_region", name="add_region")
     */
    public function addRegion(EntityManagerInterface $em, Request $request){
        $form = $this->createForm(RegionsFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $Regions = new Regions();
            
            $Regions->setNomregion($data['nomregion']);
            
            $em->persist($Regions);
            $em->flush();
            
            return ($this->redirectToRoute('add_region'));
        }
        
        return $this->render('Add/add_region.html.twig', [
            'addregions' => $form->createView(),
        ]);
        
    }
}