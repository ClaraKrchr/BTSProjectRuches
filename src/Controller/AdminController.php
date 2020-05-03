<?php

namespace App\Controller;

use App\Entity\CApiculteur;
use App\Form\EditUserType;
use App\Repository\CApiculteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class AdminController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/gestionnaire", name="gestionnaire")
     */
    public function userList(CApiculteurRepository $user)
    {
        return $this->render("admin/gestionnaire.html.twig", [
            'users' => $user->findAll()
        ]);
    }
    
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("gestionnaire/edit/{nom}", name="edit")
     */
    public function editUser(Request $request, CApiculteur $user, EntityManagerInterface $em) 
    {
        $form = $this->createForm(EditUserType::class, $user);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            
            return $this->redirectToRoute('gestionnaire');
        }
        return $this->render('admin/editUser.html.twig', ['formUser' => $form->createView()]);            
    }
}
