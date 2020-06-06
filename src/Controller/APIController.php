<?php

namespace App\Controller;

use App\Entity\MesuresRuches;
use App\Entity\CRuche;
use App\Entity\CStation;
use App\Entity\CPeseRuche;
use App\Entity\MesuresStations;
use App\Entity\AssociationRuchePeseRuche;
use App\Entity\AssociationStationRucher;
use App\Repository\MesuresRuchesRepository;
use App\Repository\MesuresStationsRepository;
use App\Repository\CRucheRepository;
use App\Repository\CStationRepository;
use App\Repository\AssociationRuchePeseRucheRepository;
use App\Repository\CPeseRucheRepository;
use App\Repository\AssociationStationRucherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

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
        
        // $response = new JsonResponse($json, 200, [], true); // équivalent du block commentaire au dessus
        
        return $this->json($mesuresRep->findAll(), 200, [], ['groups'=>'mesure:read']);
    }
    
    /**
     * @Route("/api", name="api_post", methods={"POST"})
     */
    public function post(Request $request)
    {
        $contentArray = [];
            if ($jsonContent = $request->getContent()) {
                $contentArray = json_decode($jsonContent, true);                
            }
            $idStation = current($contentArray);
            $tempertature = next($contentArray);
            $tension = next($contentArray);
            $humidite = next($contentArray);
            $pression = next($contentArray);
            for($i = 0; $i < (count($contentArray) - 5) / 2; $i++)
            {
                $idruche = next($contentArray);
                $poids = next($contentArray);
                CreateMesureRuche($idruche,
                    $poids
                );
            }

            CreateMesureStation(
                $idStation,
                $tempertature,
                $tension,
                $humidite,
                $pression
            );
            return $this->json(current($contentArray), 201, [], ['groups'=>'mesure:read']);
    }
    
    public function CreateMesureRuche(int $idRuche, float $poids, EntityManagerInterface $em)
    {
        try{
            $mesure = new MesuresRuches;
            $mesure->setDateReleve(new \datetime());
            $mesure->setPoids($poids);

            $ruche = $em->GetRepository(CRuche::class)->findOneBy(array('id'=>$idRuche));
            $mesure->setRuche($ruche);

            $assos = $em->getRepository(AssociationRuchePeseRuche::class)->findOneBy(array('ruche'=>$ruche));

            $peseRuche = $assos->getPeseruche();
            $mesure->setPeseruche($peseRuche);

            $errors = $validator->validate($mesure);
            if(count($errors)){
                return $this->json($errors, 400);
            }

            $em->persist($mesure);
            $em->flush();

            return $this->json($mesure, 201, [], ['groups'=>'mesure:read']);
        }catch(NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function CreateMesureStation(int $idStation, float $tempertature, int $tension, int $humidite, int $pression, EntityManagerInterface $em)
    {
        try{
            $mesure = new MesuresStations;
            $mesure->setDateReleve(new \datetime());
            $mesure->setTemperature($tempertature);
            $mesure->setTension($tension);
            $mesure->setHumidite($humidite);
            $mesure->setPression($pression);

            $station = $em->getRepository(CStation::class)->findOneBy(array('id'=>$idStation));
            $mesure->setStation($station);

            $assos = $em->getRepository(AssociationStationRucher::class)->findOneBy(array('station'=>$station));
            $rucher = $assos->getRucher();
            $mesure->setRucher($rucher);

            $errors = $validator->validate($mesure);
            if(count($errors)){
                return $this->json($errors, 400);
            }

            $em->persist($mesure);
            $em->flush();

            return $this->json($mesure, 201, [], ['groups'=>'mesureS:read']);
        }catch(NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
