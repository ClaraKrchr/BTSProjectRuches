<?php

namespace App\Controller;

use App\Entity\CRuche;
use App\Entity\AssociationRuchePeseruche;
use App\Entity\AssociationRucheRucher;
use App\Entity\AssociationRucheApiculteur;
use App\Entity\CPeseRuche;
use App\Entity\CRucher;

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


        $em->flush();

        return $this->redirectToRoute('tableau_donnees/Occitanie');
    }
}
