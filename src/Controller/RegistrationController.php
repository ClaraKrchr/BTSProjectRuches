<?php
/* src/Controller/RegistrationController.php */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\Persistence\ObjectManager; //ajout du manager

use App\Entity\CApiculteur;
use App\Form\RegistrationFormType;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $manager) {
        $CApiculteur = new CApiculteur();
        $form = $this->createForm(RegistrationFormType::class, $CApiculteur);
        $form->handleRequest($request);
        
        
        if($form->isSubmitted() && $form->isValid()) {
            
            $hash = $encoder->encodePassword($CApiculteur, $CApiculteur->getPassword());
            $CApiculteur->SetPassword($hash);
            $CApiculteur->setTypeuser("0");
            
            $manager->persist($CApiculteur); //persiste l�info dans le temps
            $manager->flush(); //envoie les info � la BDD
            
            $this->addFlash('creationCompte','Le compte a ete cree');
            return $this->redirectToRoute('registration');
        }
        
        return $this->render('registration/registration.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/connexion", name="security_login")
     */
    public function login()
    {
        return $this->render('security/login.html.twig');
    }
    
    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout()
    {
        
    }
    
}
