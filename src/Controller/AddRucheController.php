<?php
/* src/Controller/AddRucheController.php*/

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\CApiculteur;
use App\Entity\CPeseRuche;
use App\Entity\CRucher;
use App\Form\AddRucheFormType;

class AddRucheController extends AbstractController
{
    /**
     * @Route("/add", name="add")
     */
    public function new(EntityManagerInterface $em, Request $request) {
        $form = $this->createForm(AddRucheFormType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $CPeseRuche = new CPeseRuche();
            
            $apiculteur = $em->getRepository(CApiculteur::class)->find(1);
            $rucher = $em->getRepository(CRucher::class)->find(1);
            
            $CPeseRuche->setNomPeseRuche($data['Nom_ruche']);
            $CPeseRuche->setPoids(NULL);
            $CPeseRuche->setHumiditeInter(NULL);
            $CPeseRuche->setHumiditeExter(NULL);
            $CPeseRuche->setTempInter(NULL);
            $CPeseRuche->setTempExter(NULL);
            $CPeseRuche->setLuminosite(NULL);
            $CPeseRuche->setNivEau(NULL);
            $CPeseRuche->setDateInstall(NULL);
            $CPeseRuche->setDateReleve(NULL);
            $CPeseRuche->setTypeRuche($data['Type']);
            $CPeseRuche->setProprietaire($apiculteur);
            $CPeseRuche->setVisibilite($data['Visibilite']);
            $CPeseRuche->setRucher($rucher);
            
            $em->persist($CPeseRuche);
            $em->flush();
            
            return $this->redirectToRoute('home');
        }
        
        return $this->render('add_ruche/new_ruche.html.twig', [
            'addRucheForm' => $form->createView(),
        ]);
    }
}
