<?php

namespace App\Controller;

use App\Entity\CRuche;
use App\Entity\AssocierRuchePort;
use App\Entity\AssocierRucheRucher;
use App\Entity\AssocierRucheApiculteur;
use App\Entity\CRucher;
use App\Entity\CStation;
use App\Entity\Carnet;
use App\Entity\MesuresRuches;

use App\Form\EditRucheType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Repository\CRucheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class DeleteController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/tableau_donnees/delete/{nomruche}", name="delete_ruche")
     */
    public function deleteRuche(Request $request, CRuche $ruche, EntityManagerInterface $em)
    {
        $user=$this->getUser();
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        }
        
        //Redirection si l'utilisateur n'est pas celui qui possède la ruche
        $assosRucheApi = $em->getRepository(AssocierRucheApiculteur::class)->findOneBy(array('ruche'=>$ruche));
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('erreur403');
        //////////////////////////////
        
        $AssosRucheRucher = $this->getDoctrine()->getRepository(AssocierRucheRucher::class)->findOneBy(array('ruche'=>$ruche));
        if ($AssosRucheRucher != NULL){
            $em->remove($AssosRucheRucher); 
            $ruche->setNbassosrucher(0);
        }
        
        $RuchePort = $this->getDoctrine()->getRepository(AssocierRuchePort::class)->findOneBy(array('ruche'=>$ruche));
        if($RuchePort != NULL){$em->remove($RuchePort);}
        
        $mesuresRuches = $this->getDoctrine()->getRepository(MesuresRuches::class)->findBy(array('ruche'=>$ruche));
        $carnets = $this->getDoctrine()->getRepository(Carnet::class)->findBy(array('ruche'=>$ruche));
        if(($carnets != NULL) || ($mesuresRuches != NULL)){
            $ruche->setEtat('4');
            $ruche->setDatearchive(date_create());
            $em->flush();
            $message=utf8_encode('La ruche a été archivée.');
            $this->addFlash('message', $message);
            return $this->redirectToRoute('ruches_privees');
        }
        
        $AssosRucheApiculteur = $this->getDoctrine()->getRepository(AssocierRucheApiculteur::class)->findOneBy(array('ruche'=>$ruche));
        $em->remove($AssosRucheApiculteur);
        $em->remove($ruche);


        $em->flush();

        $message=utf8_encode('La ruche a été supprimée.');
        $this->addFlash('message', $message);
        return $this->redirectToRoute('ruches_privees');
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/tableau_donnees/dissociate_ruche_rucher/{nomruche}", name="dissociate_ruche_rucher")
     */
    public function dissociate_ruche_rucher(Request $request, CRuche $ruche, EntityManagerInterface $em)
    {
        $user=$this->getUser();
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        }
        
        //Redirection si l'utilisateur n'est pas celui qui possède la ruche
        $assosRucheApi = $em->getRepository(AssocierRucheApiculteur::class)->findOneBy(array('ruche'=>$ruche));
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('erreur403');
        //////////////////////////////
        
        $AssosRucheRucher = $this->getDoctrine()->getRepository(AssocierRucheRucher::class)->findOneBy(array('ruche'=>$ruche));
        if ($AssosRucheRucher == NULL){return $this->redirectToRoute('ruches_privees');}
        $ruche->setEtat('0');
        $ruche->setNbassosrucher(0);
        $em->remove($AssosRucheRucher);
        $RuchePort = $this->getDoctrine()->getRepository(AssocierRuchePort::class)->findOneBy(array('ruche'=>$ruche));
        if ($RuchePort == NULL){return $this->redirectToRoute('ruches_privees');}
        $ruche->setNbassosport(0);
        $em->remove($RuchePort);
        
        $em->persist($ruche);
        $em->flush();
        
        $message=utf8_encode('La ruche a été dissociée du rucher et de la station.');
        $this->addFlash('message', $message);
        return $this->redirectToRoute('ruches_privees');
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/tableau_donnees/dissociate_ruche_port/{nomruche}", name="dissociate_ruche_port")
     */
    public function dissociate_ruche_port(Request $request, CRuche $ruche, EntityManagerInterface $em)
    {
        $user=$this->getUser();
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        }
        
        //Redirection si l'utilisateur n'est pas celui qui possède la ruche
        $assosRucheApi = $em->getRepository(AssocierRucheApiculteur::class)->findOneBy(array('ruche'=>$ruche));
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('erreur403');
        //////////////////////////////
        
        $RuchePort = $this->getDoctrine()->getRepository(AssocierRuchePort::class)->findOneBy(array('ruche'=>$ruche));
        if ($RuchePort == NULL){return $this->redirectToRoute('ruches_privees');}
        $ruche->setNbassosport(0);
        $em->remove($RuchePort);
        
        $em->persist($ruche);
        $em->flush();
        
        $message=utf8_encode('La ruche a été dissociée de la station.');
        $this->addFlash('message', $message);
        return $this->redirectToRoute('ruches_privees');
    }
}
