<?php

namespace App\Controller;

use App\Entity\CRuche;
use App\Entity\AssociationRuchePeseruche;
use App\Entity\AssociationRucheRucher;
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
        $AssosRucheRucher = $this->getDoctrine()->getRepository(AssociationRucheRucher::class)->findBy(array('ruche'=>$ruche));
        $ARRLength = count($AssosRucheRucher);
        for($i = 0; $i < $ARRLength; $i++)
        {
            $em->remove($AssosRucheRucher[$i]);
        }
        $AssosRuchePeseruche = $this->getDoctrine()->getRepository(AssociationRuchePeseruche::class)->findBy(array('ruche'=>$ruche));
        $ARRLength = count($AssosRuchePeseruche);
        for($i = 0; $i < $ARRLength; $i++)
        {
            $em->remove($AssosRuchePeseruche[$i]);
        }
        $AssosRucheApiculteur = $this->getDoctrine()->getRepository(AssociationRucheApiculteur::class)->findBy(array('ruche'=>$ruche));
        $ARRLength = count($AssosRucheApiculteur);
        for($i = 0; $i < $ARRLength; $i++)
        {
            $em->remove($AssosRucheApiculteur[$i]);
        }
        
        $em->remove($ruche);
        
        $em->flush();
        
        return $this->redirectToRoute('tableau_donnees');
    }
}
