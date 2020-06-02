<?php

namespace App\Controller;

use App\Entity\CRuche;
use App\Entity\AssociationRuchePeseruche;
use App\Entity\AssociationRucheRucher;
use App\Entity\AssociationRucheApiculteur;
use App\Entity\CPeseRuche;
use App\Entity\CRucher;
use App\Entity\Carnet;
use App\Entity\MesuresRuches;

use App\Form\EditRucheType;
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

        //Redirection si l'utilisateur n'est pas celui qui possède la ruche
        $assosRucheApi = $em->getRepository(AssociationRucheApiculteur::class)->findOneBy(array('ruche'=>$ruche));
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('ruches_privees');
        //////////////////////////////
        
        $AssosRucheRucher = $this->getDoctrine()->getRepository(AssociationRucheRucher::class)->findOneBy(array('ruche'=>$ruche));
        $em->remove($AssosRucheRucher);
        
        $AssosRuchePeseruche = $this->getDoctrine()->getRepository(AssociationRuchePeseruche::class)->findOneBy(array('ruche'=>$ruche));
        $em->remove($AssosRuchePeseruche);
        
        $AssosRucheApiculteur = $this->getDoctrine()->getRepository(AssociationRucheApiculteur::class)->findOneBy(array('ruche'=>$ruche));
        $em->remove($AssosRucheApiculteur);
        
        $carnets = $this->getDoctrine()->getRepository(Carnet::class)->findBy(array('ruche'=>$ruche));
        $em->remove($carnets);
        
        $mesuresRuches = $this->getDoctrine()->getRepository(MesuresRuches::class)->findBy(array('ruche'=>$ruche));
        $em->remove($mesuresRuches);
        
        $em->remove($ruche);


        $em->flush();

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
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('ruches_privees');
        //////////////////////////////
        
        $AssosRucheRucher = $this->getDoctrine()->getRepository(AssociationRucheRucher::class)->findOneBy(array('ruche'=>$ruche));
        if ($AssosRucheRucher == NULL){return $this->redirectToRoute('ruches_privees');}
        $ruche->setEtat('0');
        $em->remove($AssosRucheRucher);
        
        
        $em->flush();
        
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
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('ruches_privees');
        //////////////////////////////
        
        $AssosRuchePeseruche = $this->getDoctrine()->getRepository(AssociationRuchePeseruche::class)->findOneBy(array('ruche'=>$ruche));
        if ($AssosRuchePeseruche == NULL){return $this->redirectToRoute('ruches_privees');}
        $em->remove($AssosRuchePeseruche);
        
        
        $em->flush();
        
        return $this->redirectToRoute('ruches_privees');
    }
}
