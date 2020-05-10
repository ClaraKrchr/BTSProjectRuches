<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Entity\CPeseRuche;
use App\Entity\AssociationPeserucheStation;
use App\Entity\CStation;

use App\Form\AddPeseRucheFormType;

class AddPeseRucheController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/add_pese_ruche", name="add_pese_ruche")
     */
    public function add_pese_ruche(EntityManagerInterface $em, Request $request)
    {
         
        
        $form = $this->createForm(AddPeseRucheFormType::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            
            $CPeseRuche = new CPeseRuche();
            $CPeseRuche->setNomPeseRuche($data['nompeseruche']);
            $CPeseRuche->setDateInstall($data['dateinstall']);
            $CPeseRuche->setVisibilite($data['visibilite']);
            
            $em->persist($CPeseRuche);
            
            $associationPeserucheStation = new AssociationPeserucheStation();
            
            $associationPeserucheStation->setPeseruche($CPeseRuche);
            $associationPeserucheStation->setStation($em->getRepository(CStation::class)->findOneBy(array('id'=>($data['nomstation'])->getId())));
            $em->persist($associationPeserucheStation);
            ($data['nomstation'])->addAssociationPeserucheStation($associationPeserucheStation);
                        
            $CPeseRuche->setAssociationPeserucheStation($associationPeserucheStation);           
            $em->flush();
            
            $message=utf8_encode('Le pèse ruche a été ajouté');
            $this->addFlash('message',$message);
            
            return $this->redirectToRoute('add_pese_ruche');
        }
        
        
        return $this->render('add_pese_ruche/add.html.twig', [
            'addPeseRucheForm' => $form->createView(),
        ]);
    }
}
