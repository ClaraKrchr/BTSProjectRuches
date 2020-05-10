<?php
/* src/Controller/SecurityController.php */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\Persistence\ObjectManager; //ajout du manager
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Entity\CApiculteur;
use App\Form\RegistrationFormType;

class SecurityController extends AbstractController
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
            
            $manager->persist($CApiculteur); //persiste l’info dans le temps
            $manager->flush(); //envoie les info à la BDD
            
            $message=utf8_encode('Le compte a été crée');
            $this->addFlash('creationCompte',$message);
            return $this->redirectToRoute('registration');
        }
        
        return $this->render('registration/registration.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils):Response
    {// get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
        
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout()
    {
        
    }
    
}
