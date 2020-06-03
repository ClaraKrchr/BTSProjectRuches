<?php

namespace App\Controller;

use App\Entity\Carnet;
use App\Entity\CRuche;
use App\Entity\AssociationRucheApiculteur;
use App\Repository\CRucheRepository;
use App\Repository\CarnetRepository;

use App\Form\CarnetFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class CarnetController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/carnet", name="carnet")
     */
    public function carnet(Request $request){
        $form = $this->createForm(CarnetFormType::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            return ($this->redirectToRoute('carnet_ruche', array('ruche'=> $data['ruche'])));
        }
        
        return $this->render('Ruches/carnet.html.twig' , [
        'carnetForm' => $form->createView()
        ]);
    }
    
    /**
     * @IsGRanted("ROLE_USER")
     * @Route("/carnet/{ruche}/{page}", name="carnet_ruche", defaults={"page"=1})
     */
    public function carnetRuche(Request $request, PaginatorInterface $paginator, $ruche, $page, EntityManagerInterface $em){
        
        //Redirection si l'utilisateur n'est pas celui qui possède la ruche
        $Ruche = $em->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$ruche));
        $assosRucheApi = $em->getRepository(AssociationRucheApiculteur::class)->findOneBy(array('ruche'=>$Ruche));
        if ($assosRucheApi->getApiculteur() != $this->getUser()) return $this->redirectToRoute('erreur');
        //////////////////////////////
        
        $rucheObjet = $this->getDoctrine()->getRepository(CRuche::class)->findOneBy(array('nomruche'=>$ruche));
        
        $qb = $em->createQueryBuilder();
        $qb->select('w')->from(Carnet::class, 'w')->where('w.ruche = ' . $rucheObjet->getId())->orderBy('w.date', 'ASC');
        $query = $qb->getQuery();
        $CarnetDate = $query->getResult();
        
        $carnet = $paginator->paginate(
            $CarnetDate,
            $page,
            1);
        
        return $this->render('Ruches/carnet_ruche.html.twig', [
            'carnets' => $carnet,
            'paginations' => $carnet,
            'ruche' => $rucheObjet,
            'date' => $CarnetDate
        ]);
    }
}
