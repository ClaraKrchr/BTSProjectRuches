<?php

namespace App\Controller;

use App\Entity\CRuche;
use App\Entity\AssociationRuchePeseruche;
use App\Entity\AssocierRucheRucher;
use App\Entity\AssociationRucheApiculteur;
use App\Entity\CPeseRuche;
use App\Entity\CRucher;
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

        //METTRE MESSAGE CARNET
        
        //Redirection si l'utilisateur n'est pas celui qui possède la ruche
        $assosRucheApi = $em->getRepository(AssociationRucheApiculteur::class)->findOneBy(array('ruche'=>$ruche));
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('erreur403');
        //////////////////////////////
        
        $AssosRucheRucher = $this->getDoctrine()->getRepository(AssocierRucheRucher::class)->findOneBy(array('ruche'=>$ruche));
        if ($AssosRucheRucher != NULL){
            $em->remove($AssosRucheRucher); 
            $ruche->setNbassosrucher(0);
        }
        
        $AssosRuchePeseruche = $this->getDoctrine()->getRepository(AssociationRuchePeseruche::class)->findOneBy(array('ruche'=>$ruche));
        if($AssosRuchePeseruche != NULL){$AssosRuchePeseruche->getPeseruche()->setNbAssosRuche(0); $em->remove($AssosRuchePeseruche);}
        
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
        
        //Redirection si l'utilisateur n'est pas celui qui possède la ruche
        $assosRucheApi = $em->getRepository(AssociationRucheApiculteur::class)->findOneBy(array('ruche'=>$ruche));
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('erreur403');
        //////////////////////////////
        
        $AssosRucheRucher = $this->getDoctrine()->getRepository(AssocierRucheRucher::class)->findOneBy(array('ruche'=>$ruche));
        if ($AssosRucheRucher == NULL){return $this->redirectToRoute('ruches_privees');}
        $ruche->setEtat('0');
        $em->remove($AssosRucheRucher);
        
        
        $em->flush();
        
        $message=utf8_encode('La ruche a été dissociée du rucher.');
        $this->addFlash('message', $message);
        return $this->redirectToRoute('ruches_privees');
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/tableau_donnees/dissociate_ruche_peseruche/{nomruche}", name="dissociate_ruche_peseruche")
     */
    public function dissociate_ruche_peseruche(Request $request, CRuche $ruche, EntityManagerInterface $em)
    {
        
        //Redirection si l'utilisateur n'est pas celui qui possède la ruche
        $assosRucheApi = $em->getRepository(AssociationRucheApiculteur::class)->findOneBy(array('ruche'=>$ruche));
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('erreur403');
        //////////////////////////////
        
        $AssosRuchePeseruche = $this->getDoctrine()->getRepository(AssociationRuchePeseruche::class)->findOneBy(array('ruche'=>$ruche));
        if ($AssosRuchePeseruche == NULL){return $this->redirectToRoute('ruches_privees');}
        $AssosRuchePeseruche->getPeseruche()->setNbAssosRuche(0);
        $em->remove($AssosRuchePeseruche);
        
        
        $em->flush();
        
        $message=utf8_encode('La ruche a été dissociée du pèse-ruche.');
        $this->addFlash('message', $message);
        return $this->redirectToRoute('ruches_privees');
    }
}
