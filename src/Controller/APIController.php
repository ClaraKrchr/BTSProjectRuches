<?php

namespace App\Controller;

use App\Entity\MesuresRuches;
// use App\Entity\CRuche;
use App\Entity\CStation;
use App\Entity\AssocierRuchePort;
use App\Entity\MesuresStations;
use App\Entity\AssocierStationRucher;
use App\Repository\MesuresRuchesRepository;
use App\Repository\MesuresStationsRepository;
use App\Repository\AssocierRuchePortRepository;
use App\Repository\CStationRepository;
use App\Repository\AssocierStationRucherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Response;

class APIController extends AbstractController
{
    /**
     * @Route("/api", name="api_index", methods={"GET"})
     */
    public function index(MesuresRuchesRepository $mesuresRep)
    {
        // $mesures = $mesuresRep->findAll();
        
        // $mesuresNorm = $normalizer->normalize($mesures, null, ['groups'=> 'mesure:read']);
        
        // $json = json_encode($mesuresNorm);
        
        // $json = $serializer->serialize($mesures, 'json', ['groups'=>'mesure:read']); // �quivalent des 2 commentaires au dessus
        
        /*
         $response = new Response($json, 200, [
         "Content-Type" => "application/json"
         ]);
         */
        
        // $response = new JsonResponse($json, 200, [], true); // �quivalent du block commentaire au dessus
        
        return $this->json($mesuresRep->findAll(), 200, [], ['groups'=>'mesure:read']);
    }
    
    /**
     * @Route("/api", name="api_post", methods={"POST"})
     */
    public function post(Request $request, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        try{
            $data = $request->query->get('Sta');
        }catch(NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
        if(!isset($data)){
            return new Response(
                'Aucune',
                400,
                ['content-type' => 'text/html']
            );
        }
        if(!($array = explode(",", $data) == 20)){
            return new Response(
                'Requête érronée: Données manquantes',
                400,
                ['content-type' => 'text/html']
            );
        }        
        try{
            $fileToW = fopen(__DIR__."/log/test.csv","a");

            fputcsv($fileToW, $array);

            $mesureS = new MesuresStations;

            $mesureS->setDateReleve(new \datetime());
            $nomStation = (int)current($array);
            $station = $em->getRepository(CStation::class)->findOneBy(array('nom'=>$nomStation));
            $assos = $em->getRepository(AssocierStationRucher::class)->findOneBy(array('station'=>$station));
            $idRucher = $assos->getRucher()->getId();
            $mesureS->setIdrucher($idRucher);

            $mesureS->setTemperature((int)next($array));
            $mesureS->setTension((float)next($array));
            $mesureS->setHumidite((int)next($array));
            $mesureS->setPression((int)next($array));

            $errors = $validator->validate($mesureS);
            if(count($errors)){
                return $this->json($errors, 400);
            }
            $em->persist($mesureS);
            $em->flush();
            // $data = fgetcsv($request, 1000, ",");

            for($i = 0; $i < 15; $i++){
                if((float)next($array) != 0){
                    $mesureR = new MesuresRuches;
                    $mesureR->setDateReleve(new \datetime());
                    $mesureR->setPoids((int)current($array));
                    $idStationPort = $idStation + $i + 1;
                    $mesureR->setIdstationport($idStationPort);
                    $assosRuchePort = $em->getRepository(AssocierRuchePort::class)->findOneBy(array('station'=>$station, 'numport'=>($i + 1)));
                    $mesureR->setIdruche($assosRuchePort->getRuche()->getId());
                    
                    $em->persist($mesureR);
                    $em->flush();
                }
            }
            return $this->json($array, 201, []);
        }catch(NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
        /*
        try{
            $contentArray = [];
            if ($jsonContent = $request->getContent()) {
                $contentArray = json_decode($jsonContent, true);                
            }

            $stationArray = [];
            $stationArray = current($contentArray);

            $mesureS = new MesuresStations;
            $mesureS->setDateReleve(new \datetime());

            $station = $em->getRepository(CStation::class)->findOneBy(array('id'=>current($stationArray)));
            $mesureS->setStation($station);

            $mesureS->setTemperature(next($stationArray));
            $mesureS->setTension(next($stationArray));
            $mesureS->setHumidite(next($stationArray));
            $mesureS->setPression(next($stationArray));

            $assos = $em->getRepository(AssociationStationRucher::class)->findOneBy(array('station'=>$station));
            $rucher = $assos->getRucher();
            $mesureS->setRucher($rucher);

            $errors = $validator->validate($mesureS);
                if(count($errors)){
                    return $this->json($errors, 400);
                }

            $em->persist($mesureS);
            $em->flush();

            $rucheArray = [];
            for($i = 0; $i < 15; $i++)
            {
                $mesureR = new MesuresRuches;
                $rucheArray = next($contentArray);
                $poids = next($rucheArray);
                if($poids != 0){
                    reset($rucheArray);
                    $mesureR->setDateReleve(new \datetime());  

                    $ruche = $em->GetRepository(CRuche::class)->findOneBy(array('id'=>current($rucheArray)));
                    $mesureR->setRuche($ruche);

                    $mesureR->setPoids(next($rucheArray));

                    $errors = $validator->validate($mesureR);
                    if(count($errors)){
                        return $this->json($errors, 400);
                    }

                    $em->persist($mesureR);
                    $em->flush();
                }
            }
            return $this->json($contentArray, 201, [], ['groups'=>'mesure:read']);
        }catch(NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
        */
    }
}