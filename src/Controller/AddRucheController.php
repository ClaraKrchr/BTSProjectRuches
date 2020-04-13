<?php
/* src/Controller/AddRucheController.php*/

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Form\AddRucheFormType;

class AddRucheController extends AbstractController
{
    /**
     * @Route("/add", name="add")
     */
    public function new(EntityManagerInterface $em)
    {
        $form = $this->createForm(AddRucheFormType::class);
        
        return $this->render('add_ruche/new_ruche.html.twig', [
            'addRucheForm' => $form->createView(),
        ]);
    }
}
