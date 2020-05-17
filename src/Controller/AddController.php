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
use App\Entity\AssociationRucherRegion;
use App\Entity\Regions;
use App\Entity\MesuresRuches;
use App\Entity\MesuresStations;
use App\Entity\Action;

use App\Form\ActionFormType;
use App\Form\AddMesuresStationsForm;
use App\Form\AddMesuresRuchesForm;
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
            
            $CRucher->setLatitude($latitude);
            $CRucher->setLongitude($longitude);
            $CRucher->setNom($data['Nom']);
            
            $em->persist($CRucher);
            
            $AssociationRucherRegion = new AssociationRucherRegion();
            
            $AssociationRucherRegion->setRucher($CRucher);
            $AssociationRucherRegion->setRegion($em->getRepository(Regions::class)->findOneBy(array('nomregion'=>$region)));
            $em->persist($AssociationRucherRegion);
            ($em->getRepository(Regions::class)->findOneBy(array('nomregion'=>$region)))->addAssociationRucherRegion($AssociationRucherRegion);
            $CRucher->setAssociationRucherRegion($AssociationRucherRegion);

            $em->flush();
            
            $message=utf8_encode('Le rucher a été ajouté');
            $this->addFlash('success',$message);
            
            return ($this->redirectToRoute('googleMap'));( $this->addFlash('Notification','Changement effectué'));
        }
        
        $ruchers = $this->getDoctrine()->getRepository(CRucher::class)->findAll();
        
        
        return $this->render('Add/add_rucher.html.twig', [
            'addrucherform' => $form->createView(),'ruchers' =>$ruchers, 'latitude'=>$latitude, 'longitude'=>$longitude, 'region'=>$region
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
    
    /**
     * @Route("/add_mesures_ruches", name="add_mesures_ruches")
     */
    public function add_mesures_ruches(EntityManagerInterface $em, Request $request)
    {
        
        
        $form = $this->createForm(AddMesuresRuchesForm::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            
            $MesuresRuches = new MesuresRuches();
            $MesuresRuches->setRuche($data['ruche']);
            $MesuresRuches->setDateReleve($data['datereleve']);
            $MesuresRuches->setPoids($data['poids']);
            $MesuresRuches->setPeseruche($data['peseruche']);
            
            $em->persist($MesuresRuches);
           
            $em->flush();
            
            $mesuresRuche=utf8_encode('La mesure a été ajouté');
            $this->addFlash('mesuresRuche',$mesuresRuche);
            
            return $this->redirectToRoute('add_mesures_ruches');
        }
        
        
        return $this->render('Add/add_mesures_ruches.html.twig', [
            'addMesuresRuchesForm' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/add_mesures_stations", name="add_mesures_stations")
     */
    public function add_mesures_stations(EntityManagerInterface $em, Request $request)
    {
        
        
        $form = $this->createForm(AddMesuresStationsForm::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            
            $MesuresStations = new MesuresStations();
            $MesuresStations->setStation($data['station']);
            $MesuresStations->setTemperature($data['temperature']);
            $MesuresStations->setTension($data['tension']);
            $MesuresStations->setHumidite($data['humidite']); 
            $MesuresStations->setPression($data['pression']);
            $MesuresStations->setDateReleve($data['datereleve']);
            $MesuresStations->setRucher($data['rucher']);
            
            $em->persist($MesuresStations);
            
            $em->flush();
            
            $mesuresStations=utf8_encode('La mesure a été ajouté');
            $this->addFlash('mesuresStations',$mesuresStations);
            
            return $this->redirectToRoute('add_mesures_stations');
        }
        
        
        return $this->render('Add/add_mesures_stations.html.twig', [
            'addMesuresStationsForm' => $form->createView(),
        ]);
    }
    
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/add_action", name="add_action")
     */
    public function addAction(EntityManagerInterface $em, Request $request){
        $form = $this->createForm(ActionFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $Action = new Action();
            
            $Action->setNomaction($data['nomaction']);
            
            $em->persist($Action);
            $em->flush();
            
            return ($this->redirectToRoute('add_action'));
        }
        
        return $this->render('Add/add_action.html.twig', [
            'addAction' => $form->createView(),
        ]);
        
    }
}