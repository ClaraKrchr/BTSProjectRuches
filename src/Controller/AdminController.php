<?php

namespace App\Controller;

use App\Entity\CApiculteur;
use App\Entity\CRucher;
use App\Entity\AssocierRucheRucher;
use App\Entity\AssocierStationRucher;
use App\Repository\CRucherRepository;
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
     * @IsGranted("ROLE_USER")
     * @Route("gestionnaire/edit/{nom}", name="edit")
     */
    public function editUser(Request $request, CApiculteur $user, EntityManagerInterface $em) 
    {
        if (($user != $this->getUser()) && !($this->isGranted('ROLE_ADMIN'))){return $this->redirectToRoute('erreur403');}
        $form = $this->createForm(EditUserType::class, $user);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            
            if ($this->isGranted('ROLE_ADMIN')) return $this->redirectToRoute('gestionnaire');
            else return $this->redirectToRoute('home');
        }
        return $this->render('admin/editUser.html.twig', ['formUser' => $form->createView()]);            
    }
    
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/ruchers", name="ruchers")
     */
    public function ruchersList(CRucherRepository $ruchers)
    {
        return $this->render("admin/ruchers.html.twig", [
            'ruchers' => $ruchers->findAll(),
            'assosRuche' => $this->getDoctrine()->getRepository(AssocierRucheRucher::class)->findAll(),
            'assosStation' => $this->getDoctrine()->getRepository(AssocierStationRucher::class)->findAll()
        ]);
    }
    
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/ruchers/delete/{nom}", name="delete_rucher")
     */
    public function delete_rucher(Request $request, CRucher $rucher, EntityManagerInterface $em)
    {        
        $ruche = $this->getDoctrine()->getRepository(AssocierRucheRucher::class)->findBy(array('rucher'=>$rucher));
        $station = $this->getDoctrine()->getRepository(AssocierStationRucher::class)->findBy(array('rucher'=>$rucher));
        if (($ruche == NULL) && ($station == NULL)){
            $em->remove($rucher);
        }
        $em->flush();
        
        $message=utf8_encode('Le rucher a été supprimé.');
        $this->addFlash('message',$message);
        return $this->redirectToRoute('ruchers');
    }
    
}
