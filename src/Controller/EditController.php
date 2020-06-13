<?php

namespace App\Controller;

use App\Entity\CRuche;
use App\Entity\AssocierRuchePort;
use App\Entity\AssocierRucheRucher;
use App\Entity\AssocierRucheApiculteur;
use App\Entity\CStation;
use App\Entity\CRucher;

use App\Form\EditRucheType;
use App\Form\EditAssosRucheRucherType;
use App\Form\EditAssosRuchePortType;
use App\Repository\CRucheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class EditController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/edit_ruche/{nomruche}", name="edit_ruche")
     */
    public function editRuche(Request $request, CRuche $ruche, EntityManagerInterface $em)
    {
        //Redirection si l'utilisateur n'est pas celui qui possède la ruche
        $assosRucheApi = $em->getRepository(AssocierRucheApiculteur::class)->findOneBy(array('ruche'=>$ruche));
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('erreur403');
        //////////////////////////////
        
        $form = $this->createForm(EditRucheType::class, $ruche);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            
            if(($data->getEtat() == 0) || ($data->getEtat() == 2)){
                $assosrucher = $this->getDoctrine()->getRepository(AssocierRucheRucher::class)->findOneBy(array('ruche'=>$ruche));
                if ($assosrucher != NULL) $em->remove($assosrucher);
                $assosport = $this->getDoctrine()->getRepository(AssocierRuchePort::class)->findOneBy(array('ruche'=>$ruche));
                if ($assosport != NULL) $em->remove($assosport);
                $ruche->setNbassosrucher(0); $ruche->setNbassosport(0);
            }
            if($data->getEtat() == 1){
                $assosrucher = $this->getDoctrine()->getRepository(AssocierRucheRucher::class)->findOneBy(array('ruche'=>$ruche));
                if ($assosrucher == NULL) $data->setEtat(0);
            }
            
            $em->flush();
            
            return $this->redirectToRoute('ruches_privees');
        }
        return $this->render('Edit/editRuche.html.twig', ['formRuche' => $form->createView()]);
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/edit_assos_ruche_rucher/{nomruche}", name="edit_assos_ruche_rucher")
     */
    public function editAssosRucheRucher(Request $request, CRuche $ruche, EntityManagerInterface $em)
    {
        //Redirection si l'utilisateur n'est pas celui qui possède la ruche
        $assosRucheApi = $em->getRepository(AssocierRucheApiculteur::class)->findOneBy(array('ruche'=>$ruche));
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('erreur403');
        //////////////////////////////
        
        $assos = $this->getDoctrine()->getRepository(AssocierRucheRucher::class)->findOneBy(array('ruche'=>$ruche));
        
        if ($assos == NULL) {
            $assos = new AssocierRucheRucher();
            $rucher = $this->getDoctrine()->getRepository(CRucher::class)->findOneBy(array('nom'=>'Aucun'));
            $assos->setRuche($ruche);
            $assos->setRucher($rucher);
        }
        
        $form = $this->createForm(EditAssosRucheRucherType::class, $assos);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            if ($data->getRucher()->getNom() != 'Aucun') {$ruche->setEtat(1); $ruche->setNbassosrucher(1);}
            else {
                $ruche->setEtat(0); 
                $ruche->setNbassosrucher(0); 
                $em->remove($data);
                $assosport = $this->getDoctrine()->getRepository(AssocierRuchePort::class)->findOneBy(array('ruche'=>$ruche));
                $ruche->setNbassosport(0);
                if ($assosport != NULL) $em->remove($assosport);
            }
            $em->persist($data);
            $em->flush();
            
            return $this->redirectToRoute('ruches_privees');
        }
        return $this->render('Edit/editAssosRucheRucher.html.twig', ['formAssosRucheRucher' => $form->createView()]);
    }
    
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/edit_assos_ruche_port/{nomruche}", name="edit_assos_ruche_port")
     */
    public function editAssosRuchePort(Request $request, CRuche $ruche, EntityManagerInterface $em)
    {
        //Redirection si l'utilisateur n'est pas celui qui possède la ruche
        $assosRucheApi = $em->getRepository(AssocierRucheApiculteur::class)->findOneBy(array('ruche'=>$ruche));
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('erreur403');
        //////////////////////////////
        
        $assos = $this->getDoctrine()->getRepository(AssocierRuchePort::class)->findOneBy(array('ruche'=>$ruche));
        if ($assos == NULL){
            $assos = new AssocierRuchePort();
            $station = $this->getDoctrine()->getRepository(CStation::class)->findOneBy(array('nom'=>'Aucune'));
            $assos->setRuche($ruche);
            $assos->setStation($station);
            $assos->setNumport(1);
        }

        $form = $this->createForm(EditAssosRuchePortType::class, $assos);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            if ($data->getStation()->getNom() != 'Aucune') $ruche->setNbassosport(1);
            else {$ruche->setNbassosport(0); $em->remove($data);}
            $em->persist($data);
            $em->flush();
            
            return $this->redirectToRoute('ruches_privees');
        }
        return $this->render('Edit/editAssosRuchePort.html.twig', ['formAssosRuchePort' => $form->createView()]);
    }

}
