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
        $user->setName('Mauquie');
        $user->setPrenom('Joel');
        $user->setMail('joel.mauquie@ac-toulouse.fr');
        $user->setMdp('jomau');
        $user->setTel('0699989796');
        $user->setCodePostal('82000');
        $user->setVille('');
        $user->setPostAddr('');
        $user->setTypeUser(0);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new user with id '.$user->getId());
    }
}
