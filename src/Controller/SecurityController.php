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


use App\Entity\CApiculteur;
use App\Form\RegistrationFormType;
use App\Repository\CApiculteurRepository;
use App\Form\ResetPasswordFormType;

class SecurityController extends AbstractController
{
    /**
     * 
     * @Route("/registration", name="registration")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $manager, MailerInterface $mailer) {
        $CApiculteur = new CApiculteur();
        $form = $this->createForm(RegistrationFormType::class, $CApiculteur);
        $form->handleRequest($request);
        
        
        if($form->isSubmitted() && $form->isValid()) {
            
            $hash = $encoder->encodePassword($CApiculteur, $CApiculteur->getPassword());
            $CApiculteur->SetPassword($hash);
            
            //On g�n�re le token d'activation
            $CApiculteur->setActivationToken(md5(uniqid()));
            
            $manager->persist($CApiculteur); //persiste l�info dans le temps
            $manager->flush(); //envoie les info � la BDD
            
            $message=utf8_encode('Le compte a �t� cr�e');
            $this->addFlash('creationCompte',$message);
            return $this->redirectToRoute('registration');
            
            /*$message = (new \Swift_Message('Activation compte'))
                ->setFrom('no-reply@gmail.com')
                ->setTo($user->getMail())
                ->setBody(
                    $this->renderView(
                        'email/activation.html.twig', ['token' => $user->getActivationToken()]
                        ),
                    'text/html');*/
            
            $message = (new Email())
                ->from('noreply.clubapi@gmail.com')
                ->to('clara.krchr@gmail.com')
                ->subject('Yo')
                ->text('Clara')
                ->html('<p>Coucou</p>');
            
            //on envoie le mail
            $mailer->send($message);
        }
        
        return $this->render('security/registration.html.twig', [
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
    
    /**
     * @Route("/password", name="forgotten_password")
     */
    public function password(Request $request, CApiculteurRepository $userRepo, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator)
    {
        //on cr�e le formualire
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
            
            //on g�n�re un token
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
            
            // on g�n�re l'url de r�initialisation de mdp
            $url = $this->generateUrl('reset_password', ['token' => $token], 
                UrlGeneratorInterface::ABSOLUTE_URL);
            
            // envoi du message
            $message = (new \Swift_Message('Mot de passe oubli�'))
            ->setFrom('no-reply@clubapi.fr')
            ->setTo($user->getMail())
            ->setBody(
                "<p>Bonjour,</p><p>Une demande de r�initialisation de mot de passe a �t� effectu�e pour le site
                du club des apiculteurs de Thal�s. Veuillez cliquer sur le lien suivant : " . $url . '</p>',
                'text/html');
            
            // on envoi le mail
            $mailer->send($message);
            
            $this->addFlash('message', 'Un e-mail pour r�initialiser votre mot de passe a �t� envoy�.');
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
            //$this->addFlash('danger', 'Lien invalide');
            return $this->redirectToRoute('erreur404');
        }
        
        //si le formualire est envoy� en m�thode post
        if($request->isMethod('POST')){
            $user->setResetToken(null);
            $user->setPassword($encoder->encodePassword($user, $request->request->get('password')));
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            $this->addFlash('message', 'Mot de passe modifi� avec succ�s');
            return $this->redirectToRoute('security_login');
        }else {
            return $this->render('security/resetpassword.html.twig', ['token' => $token]);
        }
        
    }
    
    /**
     * @Route("/activation/{token}", name="activation")
     */
    public function activation($token, CApiculteurRepository $userRepo)
    {        
        //on v�rifie si un user a ce token
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
        
        //envoi de message compte activ�
        $this->addFlash('message', 'Le compte a �t� activ�');
        return $this->redirectToRoute('home');
    }
    
}
