<?php
/* src/Controller/AddRucheController.php*/

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Entity\CApiculteur;
use App\Entity\CRuche;
use App\Entity\CRucher;
use App\Entity\CPeseRuche;
use App\Form\AddRucheFormType;
use App\Entity\AssociationRucheApiculteur;
use App\Entity\AssociationRucheRucher;
use App\Entity\AssociationRuchePeseruche;

class AddRucheController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/add_ruche", name="add_ruche")
     */
    public function new(EntityManagerInterface $em, Request $request) {
        $form = $this->createForm(AddRucheFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $CRuche = new CRuche();
                                
            $NomApiculteur=$this->getUser();
            
            $apiculteur = $em->getRepository(CApiculteur::class)->findOneBy(array('id'=>$NomApiculteur));
            
            $CRuche->setNomruche($data['Nom_ruche']);
            $CRuche->setDateinstall($data['Date_installation']);
            $CRuche->setVisibilite($data['Visibilite']);
            $CRuche->setTyperuche($data['Type_ruche']);
            $CRuche->setEtat($data['Etat']);
            
            $em->persist($CRuche);
            
            
            $AssociationRucheApiculteur = new AssociationRucheApiculteur();
            
            $AssociationRucheApiculteur->setRuche($CRuche);
            $AssociationRucheApiculteur->setApiculteur($apiculteur);
            $em->persist($AssociationRucheApiculteur);
            $apiculteur->addAssociationRucheApiculteur($AssociationRucheApiculteur);
            $CRuche->setAssociationRucheApiculteur($AssociationRucheApiculteur);
            
            
            $AssociationRucheRucher = new AssociationRucheRucher();
            
            $AssociationRucheRucher->setRuche($CRuche);
            $AssociationRucheRucher->setRucher($em->getRepository(CRucher::class)->findOneBy(array('id'=>($data['Rucher'])->getId())));
            $em->persist($AssociationRucheRucher);
            ($data['Rucher'])->addAssociationRucheRucher($AssociationRucheRucher);
            $CRuche->setAssociationRucheRucher($AssociationRucheRucher);
            
            
            $AssociationRuchePeseruche = new AssociationRuchePeseruche();
            
            $AssociationRuchePeseruche->setRuche($CRuche);
            $AssociationRuchePeseruche->setPeseruche($em->getRepository(CPeseRuche::class)->findOneBy(array('id'=>($data['PeseRuche'])->getId())));
            $em->persist($AssociationRuchePeseruche);
            ($data['PeseRuche'])->setAssociationRuchePeseruche($AssociationRuchePeseruche);
            $CRuche->setAssociationRuchePeseruche($AssociationRuchePeseruche);
            
            $em->flush();
            
            $message=utf8_encode('La ruche a été ajoutée');
            $this->addFlash('message',$message);
            
            return $this->redirectToRoute('add_ruche');
        }
        
        
        
        return $this->render('Add/new_ruche.html.twig', [
            'addRucheForm' => $form->createView(),
        ]);
    }
}
