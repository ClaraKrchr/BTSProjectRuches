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
        
        $AssosRucheRucher = $this->getDoctrine()->getRepository(AssociationRucheRucher::class)->findOneBy(array('ruche'=>$ruche));
        $em->remove($AssosRucheRucher);

        
        $em->flush();
        
        return $this->redirectToRoute('tableau_donnees');
    }
}
