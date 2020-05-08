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
use App\Form\AddRucheFormType;

class AddRucheController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/add", name="add")
     */
    public function new(EntityManagerInterface $em, Request $request) {
        $form = $this->createForm(AddRucheFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $CRuche = new CRuche();
                                
            $CRuche->setNomruche($data['Nom_ruche']);
            $CRuche->setDateinstall($data['Date_installation']);
            $CRuche->setVisibilite($data['Visibilite']);
            $CRuche->setTyperuche($data['Type_ruche']);
            $CRuche->setEtat($data['Etat']);
            
            $em->persist($CRuche);
            $em->flush();
            
            $message=utf8_encode('La ruche a été ajoutée');
            $this->addFlash('message',$message);
            
            return $this->redirectToRoute('add');
        }
        
        
        
        return $this->render('Add/new_ruche.html.twig', [
            'addRucheForm' => $form->createView(),
        ]);
    }
}
