<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\Persistence\ObjectManager;

use App\Entity\CApiculteur;
use App\Entity\CRuche;
use App\Entity\CRucher;
use App\Entity\CStation;
use App\Entity\AssocierRucheApiculteur;
use App\Entity\AssocierRucheRucher;
use App\Entity\AssocierStationRucher;
use App\Entity\AssocierRuchePort;
use App\Entity\Regions;
use App\Entity\MesuresRuches;
use App\Entity\MesuresStations;
use App\Entity\Carnet;

use App\Form\AddMesuresStationsForm;
use App\Form\AddMesuresRuchesForm;
use App\Form\AddRucheFormType;
use App\Form\AddStationFormType;
use App\Form\AddRucherFormType;
use App\Form\RegionsFormType;
use App\Form\AddCarnetFormType;

class AddController extends AbstractController{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/add_ruche", name="add_ruche")
     */
    public function add_ruche(EntityManagerInterface $em, Request $request) {
        $user=$this->getUser();
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        }
        
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
            $CRuche->setNbassosrucher(0);
            $CRuche->setNbassosport(0);
            
            
            $RucheApiculteur = new AssocierRucheApiculteur();
            
            $RucheApiculteur->setRuche($CRuche);
            $RucheApiculteur->setApiculteur($apiculteur);
            $em->persist($RucheApiculteur);
            
            if($data['Rucher']->getNom() != 'Aucun'){
                $AssociationRucheRucher = new AssocierRucheRucher();
                
                $AssociationRucheRucher->setRuche($CRuche);
                $AssociationRucheRucher->setRucher($em->getRepository(CRucher::class)->findOneBy(array('id'=>($data['Rucher'])->getId())));
                $em->persist($AssociationRucheRucher);
                $CRuche->setNbassosrucher(1);
            }
            
            if($data['Station']->getNom() != 'Aucune'){
                $RuchePort = $this->getDoctrine()->getRepository(AssocierRuchePort::class)->findOneBy(array('numport'=>$data['Port'],'station'=>$data['Station']));
                $StationRucher = $this->getDoctrine()->getRepository(AssocierStationRucher::class)->findOneBy(array('station'=>$data['Station'], 'rucher'=>$data['Rucher']));
                if (($RuchePort == NULL) && ($StationRucher != NULL)){
                    $RuchePort = new AssocierRuchePort();
                    
                    $RuchePort->setRuche($CRuche);
                    $RuchePort->setStation($em->getRepository(CStation::class)->findOneBy(array('id'=>($data['Station'])->getId())));
                    $RuchePort->setNumport($data['Port']);
                    $em->persist($RuchePort);
                    $CRuche->setNbassosport(1);
                    $message=utf8_encode('La ruche a été ajoutée.');
                    $this->addFlash('message',$message);
                }
                else{
                    if ($StationRucher == NULL){
                        $message=utf8_encode('La ruche a été ajoutée mais la station spécifiée n\'est pas dans le rucher associé. Vous pouvez en choisir une autre en consultant vos ruches.');
                        $this->addFlash('message',$message);
                    }
                    else if($RuchePort != NULL){
                        $message=utf8_encode('La ruche a été ajoutée mais le port spécifié est déjà utilisé. Vous pouvez en choisir un autre en consultant vos ruches.');
                        $this->addFlash('message',$message);
                    }
                }
            }
            else{
                $message=utf8_encode('La ruche a été ajoutée.');
                $this->addFlash('message',$message);
            }
            
            $em->persist($CRuche);
            $em->flush();
            
            return $this->redirectToRoute('add_ruche');
        }
        
        
        
        return $this->render('Add/add_ruche.html.twig', [
            'addRucheForm' => $form->createView(),
        ]);
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/add_station", name="add_station")
     */
    public function add_station(EntityManagerInterface $em, Request $request) {        
        $user=$this->getUser();
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        } 
        
        $form = $this->createForm(AddStationFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            $CStation = new CStation();
            $CStation->setNom($data['Nom_station']);
            $CStation->setDateinstall($data['Date_installation']);
            
            $em->persist($CStation);
            
            $StationRucher = new AssocierStationRucher();
            
            $StationRucher->setStation($CStation);
            $StationRucher->setRucher($em->getRepository(CRucher::class)->findOneBy(array('id'=>($data['Rucher'])->getId())));
            $em->persist($StationRucher);
            $em->flush();
            
            $message=utf8_encode('La station a été ajoutée.');
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
        $user=$this->getUser();
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        }
        
        $form = $this->createForm(AddRucherFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $CRucher = new CRucher();
            
            $CRucher->setLatitude($latitude);
            $CRucher->setLongitude($longitude);
            $CRucher->setNom($data['Nom']);
            
            $CRucher->setRegion($em->getRepository(Regions::class)->findOneBy(array('nomregion'=>$region)));
            $em->persist($CRucher);
            
            $em->flush();
            
            $message=utf8_encode('Le rucher a été ajouté.');
            $this->addFlash('success',$message);
            
            return ($this->redirectToRoute('googleMap'));
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
     * @IsGranted("ROLE_USER")
     * @Route("/add_mesures_ruches", name="add_mesures_ruches")
     */
    public function add_mesures_ruches(EntityManagerInterface $em, Request $request)
    {
        $user=$this->getUser();
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        }
        
        $form = $this->createForm(AddMesuresRuchesForm::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            
            $MesuresRuches = new MesuresRuches();
            $MesuresRuches->setIdruche($data['ruche']);
            $MesuresRuches->setDateReleve($data['datereleve']);
            $MesuresRuches->setPoids($data['poids']);
            $MesuresRuches->setIdstationport(0);
            
            $em->persist($MesuresRuches);
            
            $em->flush();
            
            $mesuresRuche=utf8_encode('La mesure a été ajoutée.');
            $this->addFlash('mesuresRuche',$mesuresRuche);
            
            return $this->redirectToRoute('add_mesures_ruches');
        }
        
        
        return $this->render('Add/add_mesures_ruches.html.twig', [
            'addMesuresRuchesForm' => $form->createView(),
        ]);
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/add_mesures_stations", name="add_mesures_stations")
     */
    public function add_mesures_stations(EntityManagerInterface $em, Request $request)
    {
        $user=$this->getUser();
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        }
        
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
            
            $mesuresStations=utf8_encode('La mesure a été ajoutée.');
            $this->addFlash('mesuresStations',$mesuresStations);
            
            return $this->redirectToRoute('add_mesures_stations');
        }
        
        
        return $this->render('Add/add_mesures_stations.html.twig', [
            'addMesuresStationsForm' => $form->createView(),
        ]);
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/add_carnet", name="add_carnet")
     */
    public function addCarnet(Request $request, ObjectManager $manager){
        $user=$this->getUser();
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        }
        
        $Carnet = new Carnet();
        $form = $this->createForm(AddCarnetFormType::class, $Carnet, array('user' => $this->getUser()->getId()));
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            $manager->persist($Carnet);
            $manager->flush();
            
            $message=utf8_encode('Une page a été ajoutée au carnet.');
            $this->addFlash('message',$message);
            
            return $this->redirectToRoute('carnet');
        }
        
        return $this->render('Add/add_carnet.html.twig', [
            'addCarnetForm' => $form->createView(),
        ]);
    }
}