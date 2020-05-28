<?php

namespace App\Controller;

use App\Entity\Carnet;
use App\Entity\CRuche;
use App\Repository\CRucheRepository;
use App\Repository\CarnetRepository;

use App\Form\CarnetFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class CarnetController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/carnet", name="carnet")
     */
    public function carnet(Request $request){
        $form = $this->createForm(CarnetFormType::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            return ($this->redirectToRoute('carnet_ruche', array('ruche'=> $data['ruche'])));
        }
        
        return $this->render('Ruches/carnet.html.twig' , [
        'carnetForm' => $form->createView()
        ]);
    }
    
    /**
     * @IsGRanted("ROLE_USER")
     * @Route("/carnet/{ruche}/{page}", name="carnet_ruche", defaults={"page"=1})
     */
    public function carnetRuche(Request $request, PaginatorInterface $paginator, $ruche, $page){
        $rucheObjet = $this->getDoctrine()->getRepository(CRuche::class)->findBy(array('nomruche'=>$ruche));
        $donnees = $this->getDoctrine()->getRepository(Carnet::class)->findBy(array('ruche'=>$rucheObjet));
        
        $carnet = $paginator->paginate(
            $donnees, 
            $page, 
            30);
        
        return $this->render('Ruches/carnet_ruche.html.twig', [
            'carnets' => $carnet, ]
        );
    }
}