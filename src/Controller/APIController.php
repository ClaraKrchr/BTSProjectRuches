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

                    $assos = $em->getRepository(AssociationRuchePeseRuche::class)->findOneBy(array('ruche'=>$ruche));
                    $peseRuche = $assos->getPeseruche();
                    $mesureR->setPeseruche($peseRuche);

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
        
    }
}