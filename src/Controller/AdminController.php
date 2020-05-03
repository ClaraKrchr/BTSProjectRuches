<?php

namespace App\Controller;

use App\Repository\CApiculteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
    /**
     * @Route("/gestionnaire", name="gestionnaire")
     */
    public function userList(CApiculteurRepository $user)
    {
        return $this->render("admin/gestionnaire.html.twig", [
            'users' => $user->findAll()
        ]);
    }
}
