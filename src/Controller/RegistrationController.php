<?php
/* src/Controller/RegistrationController.php */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Form\RegistrationFormType;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/new", name="registration")
     */
    public function new(EntityManagerInterface $em) {
        $form = $this->createForm(RegistrationFormType::class);
        
        return $this->render('registration/new.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
