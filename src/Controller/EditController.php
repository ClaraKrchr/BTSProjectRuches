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


class EditController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/tableau_donnees/edit/{nomruche}", name="edit_ruche")
     */
    public function editRuche(Request $request, CRuche $ruche, EntityManagerInterface $em)
    {
        
        $form = $this->createForm(EditRucheType::class, $ruche);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $ruche->setNomruche($data['Nom_ruche']);
            $ruche->setDateinstall($data['Date_installation']);
            $ruche->setVisibilite($data['Visibilite']);
            $ruche->setTyperuche($data['Type_ruche']);
            $ruche->setEtat($data['Etat']);
            
            $em->persist($ruche);
            
            if($data['Rucher'] != NULL){
                
                if ($em->getRepository(AssociationRucheRucher::class)->findOneBy(array('ruche'=>$ruche))){ $em->remove($em->getRepository(AssociationRucheRucher::class)->findOneBy(array('ruche'=>$ruche)));}
                
                $AssociationRucheRucher = new AssociationRucheRucher;
                $AssociationRucheRucher->setRuche($ruche);
                $AssociationRucheRucher->setRucher($em->getRepository(CRucher::class)->findOneBy(array('id'=>($data['Rucher'])->getId())));
                $em->persist($AssociationRucheRucher);
                ($data['Rucher'])->addAssociationRucheRucher($AssociationRucheRucher);
                $ruche->setAssociationRucheRucher($AssociationRucheRucher);
                
            }
            
            if($data['PeseRuche']->getNompPeseRuche() != 'Aucun'){
                
                if ($em->getRepository(AssociationRuchePeseruche::class)->findOneBy(array('ruche'=>$ruche))){ $em->remove($em->getRepository(AssociationRuchePeseruche::class)->findOneBy(array('ruche'=>$ruche)));}

                $AssociationRuchePeseruche = new AssociationRuchePeseruche();
                
                $AssociationRuchePeseruche->setRuche($ruche);
                $AssociationRuchePeseruche->setPeseruche($em->getRepository(CPeseRuche::class)->findOneBy(array('id'=>($data['PeseRuche'])->getId())));
                $em->persist($AssociationRuchePeseruche);
                ($data['PeseRuche'])->setAssociationRuchePeseruche($AssociationRuchePeseruche);
                $ruche->setAssociationRuchePeseruche($AssociationRuchePeseruche);

            }
            
            $em->flush();
            
            return $this->redirectToRoute('tableau_donnees');
        }
        return $this->render('Ruches/editRuche.html.twig', ['formRuche' => $form->createView()]);
    }
}
