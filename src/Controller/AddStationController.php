<?php
/* src/Controller/AddRucheController.php*/

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Entity\CRucher;
use App\Entity\AssociationStationRucher;
use App\Entity\CStation;
use App\Form\AddStationFormType;

class AddStationController extends AbstractController{
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
          
            $em->persist($CStation);
            
            $AssociationStationRucher = new AssociationStationRucher();
            
            $AssociationStationRucher->setStation($CStation);
            $AssociationStationRucher->setRucher($em->getRepository(CRucher::class)->findOneBy(array('id'=>($data['Rucher'])->getId())));
            $em->persist($AssociationStationRucher);
            ($data['Rucher'])->addAssociationStationRucher($AssociationStationRucher);
            $CStation->setAssociationStationRucher($AssociationStationRucher);
            $em->flush();
          
            $message=utf8_encode('La station a été ajoutée');
            $this->addFlash('message',$message);
            
            return $this->redirectToRoute('add_station');
        }
        
        
        
        return $this->render('Add/add_station.html.twig', [
            'addStationForm' => $form->createView(),
        ]);
    }
}