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
            
            $CRucher->setLocalisation($data['Localisation']);
            $CRucher->setNbRuches($data['Nb_Ruche']);
                    
            $em->persist($CRucher);
            $em->flush();
            
            return $this->redirectToRoute('home');
        }
        
        return $this->render('nouvellepage/ajout_rucher.html.twig', [
            'addrucherform' => $form->createView(),
        ]);
    }
}
