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
            
            $NomApiculteur=$data['Proprietaire'];
            $NomRucher=$data['Rucher'];
            
            
            $apiculteur = $em->getRepository(CApiculteur::class)->findOneBy(array('nom'=>$NomApiculteur));
            $rucher = $em->getRepository(CRucher::class)->findOneBy(array('nom'=>$NomRucher));
            
            $CPeseRuche->setNomPeseRuche($data['Nom_ruche']);
            $CPeseRuche->setPoids(NULL);
            $CPeseRuche->setHumiditeInter(NULL);
            $CPeseRuche->setHumiditeExter(NULL);
            $CPeseRuche->setTempInter(NULL);
            $CPeseRuche->setTempExter(NULL);
            $CPeseRuche->setLuminosite(NULL);
            $CPeseRuche->setNivEau(NULL);
            $CPeseRuche->setDateInstall($data['Date_installation']);
            $CPeseRuche->setDateReleve(NULL);
            $CPeseRuche->setTypeRuche($data['Type']);
            $CPeseRuche->setProprietaire($apiculteur);
            $CPeseRuche->setVisibilite($data['Visibilite']);
            $CPeseRuche->setRucher($rucher);
            
            $em->persist($CPeseRuche);
            $em->flush();
            
            $this->addFlash('message','La ruche a ete ajoutee');
            
            return $this->redirectToRoute('add');
        }
        
        return $this->render('Add/new_ruche.html.twig', [
            'addRucheForm' => $form->createView(),
        ]);
    }
}
