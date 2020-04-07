<?php

// src/Controller/ProductController.php
namespace App\Controller;

// ...
use App\Entity\CApiculteur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends NouvellepageController
{
    /**
     * @Route("/user", name="create_user")
     */
    public function createUser(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $user = new CApiculteur();
        $user->setName('Admin');
        $user->setPrenom('Admin');
        $user->setMail('projetruchethales@gmail.com');
        $user->setMdp('Projetruche2020');
        $user->setTel('0695096223');
        $user->setCodePostal('82000');
        $user->setVille('Montauban');
        $user->setPostAddr('rue Voltaire');
        $user->setTypeUser(0);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new user with id '.$user->getId());
    }
}
