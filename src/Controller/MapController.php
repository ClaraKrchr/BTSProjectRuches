<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\CRuche;
use App\Entity\CRucher;
use App\Entity\CStation;
use App\Entity\AssocierRuchePort;
use App\Entity\AssocierRucheRucher;
use App\Entity\AssocierRucheApiculteur;
use App\Entity\MesuresStations;
use App\Entity\MesuresRuches;
use App\Entity\Regions;
use function Symfony\Component\DependencyInjection\Exception\__toString;
use App\Entity\CApiculteur;

use Doctrine\ORM\EntityRepository;
use App\Entity\AssocierStationRucher;

class MapController extends NouvellepageController{
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/ruches_region/{regions}",name="ruches_region")
     */
    public function ruches_region($regions)
    {
        $user=$this->getUser();
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        }
        
        //--------Obtention du nom ce l'utilisateur----------------//
        $NomProprietaire=$this->getUser();
        //-------------Recherche des ruchers dans la region---------------//
        $Regions=$this->getDoctrine()->getRepository(Regions::class)->findBy(array('nomregion'=>$regions));
        $RucherRegion = $this->getDoctrine()->getRepository(CRucher::class)->findBy(array('region'=>$Regions));
        //-------------Recherche des ruches dans les ruchers-----------------//
        $RuchesRuchers= $this->getDoctrine()->getRepository(AssocierRucheRucher::class)->findBy(array('rucher'=>$RucherRegion));
        if($RuchesRuchers == NULL) $stock[] = NULL;
        foreach($RuchesRuchers as $RuchesRucher){
            $stock[]=$RuchesRucher->getRuche();
        }
        //------------Recherche des ruches appartenant a l'utilisateur connecté-------------//
        $RuchesApiculteurs = $this->getDoctrine()->getRepository(AssocierRucheApiculteur::class)->findBy(array('ruche'=>$stock,'apiculteur'=>$NomProprietaire));
        //------------Obtention des tous les liens entre les ports et les ruches------------//
        $RuchePort = $this->getDoctrine()->getRepository(AssocierRuchePort::class)->findAll();
        //------------Obtention de toutes les mesures---------------------------------------//
        $MesuresRuches = $this->getDoctrine()->getRepository(MesuresRuches::class)->findAll();
        
        return $this->render('Ruches/ruches_region.html.twig', ['apiculteurs' => $RuchesApiculteurs,'region'=>$regions, 'assosruchers' => $RuchesRuchers, 'assosports' => $RuchePort, 'mesuresruches' => $MesuresRuches]);
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/info_ruche/{nomruche}", name="info_ruche")
     */
    public function info_ruche($nomruche,EntityManagerInterface $em, Request $request){
        //------Vérifie que le compte est validé pare un Administrateur----------//
        $user=$this->getUser();
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        }
        //-----------Recherche de l'apiculteur possédant la ruche-------//
        $Ruche = $em->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche));
        $assosRucheApi = $em->getRepository(AssocierRucheApiculteur::class)->findOneBy(array('ruche'=>$Ruche));
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('erreur403');
        
        $NomProprietaire=$this->getUser();
        
        
        $Ruches=$this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche));
        //-------Récupère les mesures de la ruches----------//
        $qb = $em->createQueryBuilder();
        $qb->select('w')->from(MesuresRuches::class, 'w')->where('w.idruche = ' . $Ruches->getId())->orderBy('w.date_releve', 'ASC');
        $query = $qb->getQuery();
        $MesuresRuches = $query->getResult();
        
        $dateinstall= $this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche))->getDateInstall();
        //---------------Récupère les mesures de la station si la ruche est associée à un port--------------//
        $Station=$this->getDoctrine()->getRepository(AssocierRuchePort::class)->findOneBy(array('ruche'=>$Ruches));
        if ($Station != NULL){
            $Station=$Station->getStation();
            $qb = $em->createQueryBuilder();
            $qb->select('w')->from(AssocierStationRucher::class, 'w')->where('w.station = ' . $Station->getId());
            $query = $qb->getQuery();
            $Rucher=$query->getSingleResult();
            
            $qb = $em->createQueryBuilder();
            $qb->select('w')->from(MesuresStations::class, 'w')->where('w.idrucher = ' . $Rucher->getRucher()->getId())->orderBy('w.date_releve', 'ASC');
            $query = $qb->getQuery();
            $MesuresStations=$query->getResult();
            return $this->render('Ruches/info_ruche.html.twig',[
                'nomruche'=>$nomruche,'proprietaire'=>$NomProprietaire,'dateinstall'=>$dateinstall,
                'mesuresstations'=>$MesuresStations,'station'=>$Station,'rucher'=>$Rucher->getRucher()->getNom(),'mesuresruches'=>$MesuresRuches,
            ]);
        }
        else{
            $MesuresStations = NULL;
            return $this->render('Ruches/info_ruche.html.twig',[
                'nomruche'=>$nomruche,'proprietaire'=>$NomProprietaire,'dateinstall'=>$dateinstall,
                'mesuresstations'=>$MesuresStations,'mesuresruches'=>$MesuresRuches,
            ]);
        }
        
    }
    
    //---Passe toutes les mesures de la ruche sous format json---//
    
    /**
     * @Route("/mesures_ruche_diagramme/{nomruche}/{nomruche2}", name="mesures_ruche_diagramme")
     *
     * @param $nomruche
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function mesures_ruche_diagramme($nomruche,$nomruche2, EntityManagerInterface $em):Response
    {
        $stock=[];
        if($nomruche!='NULL'){
            if($nomruche2!='NULL'){
                $Ruches=$this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche));
                
                if($Ruches){//Récupère les mesures de la ruche et les stocke dans la variable $stock
                $qb = $em->createQueryBuilder();
                $qb->select('w')->from(MesuresRuches::class, 'w')->where('w.idruche = ' . $Ruches->getId())->orderBy('w.date_releve', 'ASC');
                $query = $qb->getQuery();
                $MesuresRuches = $query->getResult();
                if($MesuresRuches){
                    foreach ($MesuresRuches as $MesuresRuche){
                        $stockage1[] = array(
                            $MesuresRuche->getDateReleve()->getTimestamp()*1000,
                            $MesuresRuche->getPoids()
                        );
                    }
                    $stock[]=array('name'=>$nomruche,'data'=>$stockage1);
                }
                }
                $Ruches2=$this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche2));
                if($Ruches2){//Récupère les mesures de la seconde ruche et les stocke dans la variable $stock
                $qb = $em->createQueryBuilder();
                $qb->select('w')->from(MesuresRuches::class, 'w')->where('w.idruche = ' . $Ruches2->getId())->orderBy('w.date_releve', 'ASC');
                $query = $qb->getQuery();
                $MesuresDeRuches = $query->getResult();
                
                if($MesuresDeRuches){
                    foreach ($MesuresDeRuches as $MesuresDeRuche){
                        
                        $stockage2[]= array(
                            $MesuresDeRuche->getDateReleve()->getTimestamp()*1000,
                            $MesuresDeRuche->getPoids()
                        );
                    }
                    $stock[]=array('name'=>$nomruche2,'data'=>$stockage2);
                }
                }                
                return new Response(json_encode($stock));
            }else{
                $Ruches=$this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche));
                if($Ruches){//Récupère les mesures de la ruche et les stocke dans la variable $stock
                $qb = $em->createQueryBuilder();
                $qb->select('w')->from(MesuresRuches::class, 'w')->where('w.idruche = ' . $Ruches->getId())->orderBy('w.date_releve', 'ASC');
                $query = $qb->getQuery();
                $MesuresRuches = $query->getResult();
                
                foreach ($MesuresRuches as $MesuresRuche){
                    
                    $stockage[] = array(
                        $MesuresRuche->getDateReleve()->getTimestamp()*1000,
                         $MesuresRuche->getPoids()
                    );
                } 
                $stock=array(['name'=>'poids','data'=>$stockage]);
                return new Response(json_encode($stock));
                }
            }
        }
        return new Response(json_encode($stock));
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/ruches_desactivees", name="ruches_desactivees")
     */
    public function ruches_desactivees(EntityManagerInterface $em, Request $request){
        $user=$this->getUser();
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        }
        
        $qb = $em->createQueryBuilder();
        $qb->select('w')->from(CRuche::class, 'w')->where('w.etat = 4')->orderBy('w.datearchive', 'ASC');
        $query = $qb->getQuery();
        $sendRuches = $query->getResult();
        
        $RuchesApiculteurs = $this->getDoctrine()->getRepository(AssocierRucheApiculteur::class)->findAll();
        
        return $this->render('Ruches/ruches_desactivees.html.twig', ['ruches' => $sendRuches, 'rucheapis' => $RuchesApiculteurs]);
    }  
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/details_ruches/{nomruche}", name="details_ruches")
     */
    public function details_ruches($nomruche,EntityManagerInterface $em, Request $request){
        $user=$this->getUser();
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        }
        
        $Ruches=$this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$nomruche));
        $assosRucheApi = $em->getRepository(AssocierRucheApiculteur::class)->findOneBy(array('ruche'=>$Ruches->getId()));
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('erreur403');
        
        $NomProprietaire=$this->getUser();
        //----------------Récupère les ruches de l'apiculteur et les ruches publiques------------//
        $RuchesApiculteurs = $this->getDoctrine()->getRepository(AssocierRucheApiculteur::class)->findBy(array('apiculteur'=>$NomProprietaire));
        $RuchesPublic =  $this->getDoctrine()->getRepository(CRuche::class)->findBy(array('visibilite'=>'0'));
        
        return $this->render('Ruches/detail_ruche.html.twig',['nomruche'=>$nomruche,'proprietaire'=>$NomProprietaire,'ruchepubliques'=>$RuchesPublic,'rucheprivees'=>$RuchesApiculteurs]);
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/details_stations/{nomstation}/{nomruche}", name="details_stations")
     */
    public function details_stations($nomstation,$nomruche,EntityManagerInterface $em, Request $request){
        $user=$this->getUser();
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        }
        //------Récupère le rucher lié à la station-------//
        $Station = $this->getDoctrine()->getRepository(CStation::class)->findOneBy(array('nom'=>$nomstation));
        $qb = $em->createQueryBuilder();
        $qb->select('w')->from(AssocierStationRucher::class, 'w')->where('w.station = ' . $Station->getId());
        $query = $qb->getQuery();
        $Rucher=$query->getSingleResult();
        
        return $this->render('Ruches/detail_station.html.twig',['nomstation'=>$Station->getNom(),'nomruche'=>$nomruche,'rucher'=>$Rucher->getRucher()->getNom()]);
    }
    
    /**
     * @Route("/mesures_station_diagramme/{nomstation}", name="mesures_station_diagramme")
     *
     * @param $nomruche
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function mesures_station_diagramme($nomstation, EntityManagerInterface $em):Response
    {
      $stock=[];
        if($nomstation!='NULL'){            
            
                $Station = $this->getDoctrine()->getRepository(CStation::class)->findOneBy(array('nom'=>$nomstation));
                if($Station){//Récupère les valeurs des mesures de la station et les stocke en fonction du nom de la mesure
                    $qb = $em->createQueryBuilder();
                    $qb->select('w')->from(AssocierStationRucher::class, 'w')->where('w.station = ' . $Station->getId());
                    $query = $qb->getQuery();
                    $Rucher=$query->getSingleResult();
                    
                    $qb = $em->createQueryBuilder();
                    $qb->select('w')->from(MesuresStations::class, 'w')->where('w.idrucher = ' . $Rucher->getRucher()->getId())->orderBy('w.date_releve', 'ASC');
                    $query = $qb->getQuery();
                    $MesuresStations=$query->getResult();
                    foreach ($MesuresStations as $MesuresStation){
                        $temperature[] = array(
                            $MesuresStation->getDateReleve()->getTimestamp()*1000,
                            $MesuresStation->getTemperature()
                        );
                        $tension[]=array(
                            $MesuresStation->getDateReleve()->getTimestamp()*1000,
                            $MesuresStation->getTension()
                        ); 
                        $humidite[]=array(
                            $MesuresStation->getDateReleve()->getTimestamp()*1000,
                            $MesuresStation->getHumidite()
                        );
                        $pression[]=array(
                            $MesuresStation->getDateReleve()->getTimestamp()*1000,
                            $MesuresStation->getPression()
                        );
                    }
                    $stock=array([['name'=>'temperature','data'=>$temperature,"color"=>'#1111FF']],[['name'=>'tension','data'=>$tension,"color"=>'#FF11FF']],[['name'=>'humidite','data'=>$humidite,"color"=>'#FF1111']],[['name'=>'pression','data'=>$pression,"color"=>'#11FF11']]);
                }
                    return new Response(json_encode($stock));
                }
                return new Response(json_encode($stock));
           
    }
}