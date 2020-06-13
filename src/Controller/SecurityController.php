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
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport;
use Symfony\Component\Mailer\Bridge\Google\Smtp\GmailTransport;
use App\Services\Mailer;

use App\Entity\CApiculteur;
use App\Form\RegistrationFormType;
use App\Repository\CApiculteurRepository;
use App\Form\ResetPasswordFormType;

class SecurityController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $manager, Mailer $mailer) {
        $CApiculteur = new CApiculteur();
        $form = $this->createForm(RegistrationFormType::class, $CApiculteur);
        $form->handleRequest($request);
        
        
        if($form->isSubmitted() && $form->isValid()) {
            
            $hash = $encoder->encodePassword($CApiculteur, $CApiculteur->getPassword());
            $CApiculteur->SetPassword($hash);
            
            //On génère le token d'activation
            $CApiculteur->setActivationToken(md5(uniqid()));
            
            $manager->persist($CApiculteur); //persiste l’info dans le temps
            $manager->flush(); //envoie les info à la BDD
            
            $message=utf8_encode('Le compte a été crée');
            $this->addFlash('creationCompte',$message);
            return $this->redirectToRoute('registration');
            
            $bodyMailer = $mailer->createBodyMail('email/activation.html.twig', [
                'user' => $CApiculteur
            ]);
            
            $mailer->sendMessage('noreply.clubapi@gmail.com', 'clara.krchr@gmail.com', 'Activation', $bodyMail);
        }
        
        return $this->render('security/registration.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/activation/{token}", name="activation")
     */
    public function activation($token, CApiculteurRepository $userRepo)
    {
        //on vérifie si un user a ce token
        $user = $userRepo->findOneBy(['activationtoken' => $token]);
        
        //si le token n'existe pas
        if(!$user){
            return $this->redirectToRoute('erreur404');
        }
        
        //on supprime le token
        $user->setActivationtoken(null);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        
        //envoi de message compte activé
        $message=utf8_encode('Le compte a été activé');
        $this->addFlash('message',$message);
        return $this->redirectToRoute('home');
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
    
    /**
     * @Route("/password", name="forgotten_password")
     */
    public function password(Request $request, CApiculteurRepository $userRepo, Mailer $mailer, TokenGeneratorInterface $tokenGenerator)
    {
        //on crée le formualire
        $form = $this->createForm(ResetPasswordFormType::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $donnees = $form->getData();
            $user = $userRepo->findOneBy(array('mail'=>$donnees['mail']));
            
            //si l'user n'existe pas
            if(!$user){
                $this->addFlash('danger', 'Cette adresse n\'existe pas');
                return $this->redirectToRoute('security_login');
            }
            
            //on génère un token
            $token = $tokenGenerator->generateToken();
            
            try{
                $user->setResetToken($token);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
            } catch(\Exception $e) {
                $this->addFlash('warning', 'Une erreur est survenue');
                return $this->redirectToRoute('security_login');
            }
            
            // on génère l'url de réinitialisation de mdp
            $url = $this->generateUrl('reset_password', ['token' => $token], 
                UrlGeneratorInterface::ABSOLUTE_URL);
            
            $bodyMail = $mailer->createBodyMail('email/mdp.html.twig', [
                'user'=>$user
            ]);
            
            $email=utf8_encode('Réinitialisation du mot de passe.');
            $mailer->sendMessage('noreply.clubapi@gmail.com', $user->getMail(), $email, $bodyMail);
            
            $message=utf8_encode('Un e-mail vous a été envoyé pour changer votre mot de passe.');
            $this->addFlash('message',$message);
            
            return $this->redirectToRoute('security_login');
        }
        
        // on envoi vers la page de demande de l'email
        return $this->render('security/oublimdp.html.twig', ['mailForm'=>$form->createView()]);
    }
    
    
    /**
     * @Route("/reset_password/{token}", name="reset_password")
     */
    public function resetPassword($token, Request $request, UserPasswordEncoderInterface $encoder){
        // on va chercher l'user avec le token
        $user = $this->getDoctrine()->getRepository(CApiculteur::class)->findOneBy(['resettoken' => $token]);
        
        if(!$user){
            return $this->redirectToRoute('erreur404');
        }
        
        //si le formualire est envoyé en méthode post
        if($request->isMethod('POST')){
            $user->setResetToken(null);
            $user->setPassword($encoder->encodePassword($user, $request->request->get('password')));
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            $message=utf8_encode('Mot de passe modifié avec succès');
            $this->addFlash('message',$message);
            return $this->redirectToRoute('security_login');
        }else {
            return $this->render('security/resetpassword.html.twig', ['token' => $token]);
        }     
    }
}
