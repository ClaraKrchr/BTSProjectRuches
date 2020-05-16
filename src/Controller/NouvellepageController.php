<?php

namespace App\Controller;

use App\Entity\CApiculteur;
use App\Entity\CRucher;
use App\Entity\Carnet;
use App\Entity\AssociationRucheCarnet;
use App\Entity\AssociationActionCarnet;
use App\Entity\AssociationApiculteurCarnet;

use App\Form\CarnetFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CarnetRepository;

class NouvellepageController extends AbstractController
{
    
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('base.html.twig');
    }
    
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/ruches_privees", name="ruches_privees")
     */
    public function ruches_privees()
    {
        return $this->render('Ruches/ruches_privees.html.twig');
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/googleMap", name="googleMap")
     */
    public function googleMap(){
        $ruchers = $this->getDoctrine()->getRepository(CRucher::class)->findAll();
        return $this->render('map/googleMap.html.twig', ['ruchers' => $ruchers,]);
    }
    /**
     * @Route("/change_locale/{locale}", name="change_locale")
     */
    public function changeLocale($locale, Request $request){
        // on stocke la langue demandée dans la session
        $request->getSession()->Set('_locale',$locale);
        
        // on reviens sur la page précédente
        return $this->redirect($request->headers->get('referer'));
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/carnet", name="carnet")
     */
    public function carnet(CarnetRepository $carnet){
        return $this->render('Ruches/carnet.html.twig' , [
            'carnet' => $carnet->findAll()
        ]);
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/add_carnet", name="add_carnet")
     */
    public function addCarnet(Request $request, EntityManagerInterface $em){
        $form = $this->createForm(CarnetFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $Carnet = new Carnet();
            
            $NomApiculteur=$this->getUser();
            
            $apiculteur = $em->getRepository(CApiculteur::class)->findOneBy(array('id'=>$NomApiculteur));
            
            $Carnet->setDate($data['Date']);
            $Carnet->setCommentaire($data['Commentaire']);
            
            $em->persist($Carnet);
            
            $associationRucheCarnet = new AssociationRucheCarnet();            
            $associationRucheCarnet->setRuche($CRuche);
            $associationRucheCarnet->setCarnet($Carnet);
            $em->persist($associationRucheCarnet);
            $CRuche->addAssociationRucheCarnet($associationRucheCarnet);
            $Carnet->setAssociationRucheCarnet($associationRucheCarnet);
            
            $associationActionCarnet = new AssociationActionCarnet();
            $associationActionCarnet->setAction($action);
            $associationActionCarnet->setCarnet($Carnet);
            $em->persist($associationActionCarnet);
            $action->addAssociationActionCarnet($associationActionCarnet);
            $Carnet->setAssociationActionCarnet($associationActionCarnet);
            
            $associationApiculteurCarnet = new AssociationApiculteurCarnet();
            $associationApiculteurCarnet->setApiculteur($apiculteur);
            $associationApiculteurCarnet->setCarnet($Carnet);
            $em->persis($associationApiculteurCarnet);
            $apiculteur->addAssociationApiculteurCarnet($associationApiculteurCarnet);
            $Carnet->setAssociationApiculteurCarnet($associationApiculteurCarnet);
        }
        
        $em->flush();
        
        return $this->render('Add/add_carnet.html.twig', [
            'addCarnetForm' => $form->createView(),
        ]);
    }
}
    
        
        
        
        