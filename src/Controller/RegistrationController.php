<?php
/* src/Controller/RegistrationController.php */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\CApiculteur;
use App\Form\RegistrationFormType;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function new(EntityManagerInterface $em, Request $request) {
        $form = $this->createForm(RegistrationFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $CApiculteur = new CApiculteur();
            
            $CApiculteur->setName($data['Nom']);
            $CApiculteur->setPrenom($data['Prenom']);
            $CApiculteur->setMail($data['Adresse_mail']);
            $CApiculteur->setMdp($data['Mot_de_passe']);
            $CApiculteur->setTel($data['Telephone']);
            $CApiculteur->setCodePostal($data['Code_postal']);
            $CApiculteur->setVille($data['Ville']);
            $CApiculteur->setPostAddr($data['Adresse_postale']);
            $CApiculteur->setTypeUser(0);
            
            $em->persist($CApiculteur);
            $em->flush();
            
            return $this->redirectToRoute('index');
        }
        
        return $this->render('registration/new.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
