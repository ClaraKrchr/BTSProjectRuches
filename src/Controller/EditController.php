<?php

namespace App\Controller;

use App\Entity\CRuche;
use App\Entity\AssociationRuchePort;
use App\Entity\AssocierRucheRucher;
use App\Entity\AssocierRucheApiculteur;
use App\Entity\CStation;
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
        //Redirection si l'utilisateur n'est pas celui qui possède la ruche
        $assosRucheApi = $em->getRepository(AssocierRucheApiculteur::class)->findOneBy(array('ruche'=>$ruche));
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('erreur403');
        //////////////////////////////
        
        $form = $this->createForm(EditRucheType::class, $ruche);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $ruche->setNomruche($data['Nom_ruche']);
            $ruche->setDateinstall($data['Date_installation']);
            $ruche->setVisibilite($data['Visibilite']);
            $ruche->setTyperuche($data['Type_ruche']);
            $ruche->setEtat($data['Etat']);
            $ruche->setNbassosrucher(0);
            $ruche->setNbassosport(0);
            
            if($data['Rucher'] != 'Aucun'){
                
                if ($em->getRepository(AssocierRucheRucher::class)->findOneBy(array('ruche'=>$ruche))){ $em->remove($em->getRepository(AssocierRucheRucher::class)->findOneBy(array('ruche'=>$ruche)));}
                
                $AssocierRucheRucher = new AssocierRucheRucher;
                $AssocierRucheRucher->setRuche($ruche);
                $AssocierRucheRucher->setRucher($em->getRepository(CRucher::class)->findOneBy(array('id'=>($data['Rucher'])->getId())));
                $em->persist($AssocierRucheRucher);
                $ruche->setNbassosrucher(1);
                
            }
            
            if($data['Station']->getNom() != 'Aucune'){
                
                if ($em->getRepository(AssocierRuchePort::class)->findOneBy(array('ruche'=>$ruche))){ $em->remove($em->getRepository(AssocierRuchePort::class)->findOneBy(array('ruche'=>$ruche)));}

                $RuchePort = new AssocierRuchePort();
                
                $RuchePort->setRuche($ruche);
                $RuchePort->setStation($em->getRepository(CStation::class)->findOneBy(array('id'=>($data['Station'])->getId())));
                $RuchePort->setNumport($data['Port']);
                $em->persist($RuchePort);
                $ruche->setNbassosport(1);

            }
            
            $em->persist($ruche);
            $em->flush();
            
            return $this->redirectToRoute('tableau_donnees');
        }
        return $this->render('Ruches/editRuche.html.twig', ['formRuche' => $form->createView()]);
    }

}
