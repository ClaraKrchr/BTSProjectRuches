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
     * @Route("/ajout_rucher", name="ajout_rucher")
     */
    public function new(EntityManagerInterface $em, Request $request) {
        $form = $this->createForm(AddRucherFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $CRucher = new CRucher();
            
            $CRucher->setRegion($data['Region']);
            $CRucher->setNbRuches($data['Nb_Ruche']);
            $CRucher->setLatitude($data['Latitude']);
            $CRucher->setLongitude($data['Longitude']);
            $CRucher->setNom($data['Nom']);
                    
            $em->persist($CRucher);
            $em->flush();
            
            $this->addFlash('success','Le rucher a ete ajoute');
            
            return ($this->redirectToRoute('ajout_rucher'));( $this->addFlash('Notification','Changement effectué'));
        }
        
        $ruchers = $this->getDoctrine()->getRepository(CRucher::class)->findAll();
        return $this->render('nouvellepage/ajout_rucher.html.twig', [
            'addrucherform' => $form->createView(),'ruchers' =>$ruchers,
        ]);
    }
}
