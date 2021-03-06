<?php

namespace App\Controller;

use App\Entity\CRuche;
use App\Entity\CRucher;
use App\Entity\AssocierRucheRucher;
use App\Entity\AssocierRucheApiculteur;
use App\Entity\AssocierRuchePort;
use App\Entity\MesuresStations;
use App\Entity\MesuresRuches;
use App\Entity\AssociationRucherRegion;
use App\Entity\Regions;
use function Symfony\Component\DependencyInjection\Exception\__toString;
use App\Entity\CApiculteur;
use App\Repository\CApiculteurRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;


class NouvellepageController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('base.html.twig');
    }


    /**
     * @IsGranted("ROLE_USER")
     * @Route("/ruches_privees", name="ruches_privees")
     */
    public function ruches_privees()
    {           
        $user=$this->getUser();                            
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        }

        //--------Obtention du nom ce l'utilisateur----------------//
        $NomProprietaire=$this->getUser();

        //------------Recherche des ruches appartenant a l'utilisateur connect�-------------//
        $RuchesApiculteurs = $this->getDoctrine()->getRepository(AssocierRucheApiculteur::class)->findBy(array('apiculteur'=>$NomProprietaire));
        $RucheRuchers = $this->getDoctrine()->getRepository(AssocierRucheRucher::class)->findAll();
        $RuchePort = $this->getDoctrine()->getRepository(AssocierRuchePort::class)->findAll();
        $MesuresRuches = $this->getDoctrine()->getRepository(MesuresRuches::class)->findAll();
        return $this->render('Ruches/ruches_privees.html.twig', ['apiculteurs' => $RuchesApiculteurs, 'assosruchers' => $RucheRuchers, 'assosports' => $RuchePort, 'mesuresruches' => $MesuresRuches]);

        }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/googleMap", name="googleMap")
     */
    public function googleMap(){
        $user=$this->getUser();
        if($user->getActivationtoken()!=NULL){
            return $this->redirectToRoute('erreur_compte');
        }
        
        $ruchers = $this->getDoctrine()->getRepository(CRucher::class)->findAll();
        return $this->render('map/googleMap.html.twig', ['ruchers' => $ruchers,]);
    }
    
    /**
     * @Route("/change_locale/{locale}", name="change_locale")
     */
    public function changeLocale($locale, Request $request){
        // on stocke la langue demand�e dans la session
        $request->getSession()->Set('_locale',$locale);

        // on reviens sur la page pr�c�dente
        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/erreur403", name="erreur403")
     */
    public function erreur403()
    {
        return $this->render('security/erreur403.html.twig');
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/erreur404", name="erreur404")
     */
    public function erreur404()
    {
        return $this->render('security/erreur404.html.twig');
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/erreur_port", name="erreur_port")
     */
    public function erreur_port(){
        return $this->render('security/erreurStationPort.html.twig');
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/erreur_compte", name="erreur_compte")
     */
    public function erreur_compte(){
        return $this->render('security/erreurCompte.html.twig');
    }
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/erreur_station", name="erreur_station")
     */
    public function erreur_station(){
        return $this->render('security/erreurStation.html.twig');
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/erreur_rucher_carte", name="erreur_rucher_carte")
     */
    public function erreur_rucher_carte(){
        return $this->render('security/erreur_rucher_carte.html.twig');
    }

}