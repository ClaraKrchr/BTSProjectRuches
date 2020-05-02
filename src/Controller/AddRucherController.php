<?php
/* src/Controller/RegistrationController.php */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\CRucher;
use App\Form\AddRucherFormType;
class AddRucherController extends AbstractController
{
    /**
     * @Route("/ajout_rucher/{latitude}/{longitude}", name="ajout_rucher")
     */
    public function new($latitude, $longitude, EntityManagerInterface $em, Request $request) {
        $form = $this->createForm(AddRucherFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $CRucher = new CRucher();
            
            $CRucher->setRegion($data['Region']);
            $CRucher->setNbRuches($data['Nb_Ruche']);
            $CRucher->setLatitude($latitude);
            $CRucher->setLongitude($longitude);
            $CRucher->setNom($data['Nom']);
                    
            $em->persist($CRucher);
            $em->flush();
            
            $message=utf8_encode('Le rucher a été ajouté');
            $this->addFlash('success',$message);
            
            return ($this->redirectToRoute('googleMap'));( $this->addFlash('Notification','Changement effectué'));
        }
        
        $ruchers = $this->getDoctrine()->getRepository(CRucher::class)->findAll();
        
        
        return $this->render('Add/ajout_rucher.html.twig', [
            'addrucherform' => $form->createView(),'ruchers' =>$ruchers,
        ]);
    }
}
