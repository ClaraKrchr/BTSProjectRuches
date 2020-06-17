<?php

namespace App\Controller;

use App\Entity\CApiculteur;
use App\Entity\CRucher;
use App\Entity\CStation;
use App\Entity\AssocierRucheRucher;
use App\Entity\AssocierStationRucher;
use App\Entity\AssocierRuchePort;
use App\Repository\CStationRepository;
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
     * @Route("/gestionnaire_admin", name="gestionnaire_admin")
     */
    public function gestionnaire_admin()
    {
        return $this->render("admin/gestionnaire_admin.html.twig",);
    }
    
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
        else{
            $message=utf8_encode('Le rucher n\'est pas vide.');
            $this->addFlash('message',$message);
            return $this->redirectToRoute('ruchers');
        }
        $em->flush();
        
        $message=utf8_encode('Le rucher a été supprimé.');
        $this->addFlash('message',$message);
        return $this->redirectToRoute('ruchers');
    }
    
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/stations", name="stations")
     */
    public function stationsList(CStationRepository $stations)
    {
        return $this->render("admin/stations.html.twig", [
            'stations' => $stations->findAll(),
            'assosRuche' => $this->getDoctrine()->getRepository(AssocierRuchePort::class)->findAll(),
            'assosRucher' => $this->getDoctrine()->getRepository(AssocierStationRucher::class)->findAll()
        ]);
    }
    
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/stations/delete/{nom}", name="delete_station")
     */
    public function delete_station(Request $request, CStation $station, EntityManagerInterface $em)
    {
        $ruche = $this->getDoctrine()->getRepository(AssocierRuchePort::class)->findBy(array('station'=>$station));
        if ($ruche == NULL){
            $em->remove($this->getDoctrine()->getRepository(AssocierStationRucher::class)->findOneBy(array('station'=>$station)));
            $em->remove($station);
        }
        else{
            $message=utf8_encode('La station n\'est pas vide.');
            $this->addFlash('message',$message);
            return $this->redirectToRoute('stations');
        }
        $em->flush();
        
        $message=utf8_encode('La station a été supprimée.');
        $this->addFlash('message',$message);
        return $this->redirectToRoute('stations');
    }
    
}
