<?php

namespace App\Controller;

use App\Entity\MesuresRuches;
use App\Entity\CRuche;
use App\Entity\CPeseRuche;
use App\Repository\MesuresRuchesRepository;
use App\Repository\CRucheRepository;
use App\Repository\CPeseRucheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
        
        // $json = $serializer->serialize($mesures, 'json', ['groups'=>'mesure:read']); // équivalent des 2 commentaires au dessus
        
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
    public function post(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $jsonRec = $request->getContent();
        
        try{
            $mesure = $serializer->deserialize($jsonRec, MesuresRuches::class, 'json');
            
            $ruche = $em->getRepository(CRuche::class)->findOneBy(array('id'=>'42'));
            $mesure->SetRuche($ruche);
            
            $peseRuche = $em->getRepository(CPeseRuche::class)->findOneBy(array('id'=>'50'));
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
}
