<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarnetRepository")
 */
class Carnet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CRuche", inversedBy="carnets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ruche;

    /**
     * @ORM\Column(type="smallint")
     */
    private $action;

    /**
     * @ORM\Column(type="string", length=7, nullable=true)
     */
    private $etat_ruche;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_cadres_couvain;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $presence_males;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $presence_larves;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $presence_oeufs;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $couvain_opercule;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $eatt_essaim;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_reine;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $cellules_royales;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $race_reine;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age_reine;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_cadres_miel;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbCadresPollen;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_traitement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nature_traitement;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNourrissement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $qttNourrissement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $natureNourrissement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $origineEssaim;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbHausseRecoltees;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateRecolte;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $natureMiel;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $presenceVarroa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etatAbeilles;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateTranshumance;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $lieuTranshumance;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getRuche(): ?CRuche
    {
        return $this->ruche;
    }

    public function setRuche(?CRuche $ruche): self
    {
        $this->ruche = $ruche;

        return $this;
    }

    public function getAction(): ?int
    {
        return $this->action;
    }

    public function setAction(int $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getEtatRuche(): ?string
    {
        return $this->etat_ruche;
    }

    public function setEtatRuche(?string $etat_ruche): self
    {
        $this->etat_ruche = $etat_ruche;

        return $this;
    }

    public function getNbCadresCouvain(): ?int
    {
        return $this->nb_cadres_couvain;
    }

    public function setNbCadresCouvain(?int $nb_cadres_couvain): self
    {
        $this->nb_cadres_couvain = $nb_cadres_couvain;

        return $this;
    }

    public function getPresenceMales(): ?string
    {
        return $this->presence_males;
    }

    public function setPresenceMales(?string $presence_males): self
    {
        $this->presence_males = $presence_males;

        return $this;
    }

    public function getPresenceLarves(): ?string
    {
        return $this->presence_larves;
    }

    public function setPresenceLarves(?string $presence_larves): self
    {
        $this->presence_larves = $presence_larves;

        return $this;
    }

    public function getPresenceOeufs(): ?string
    {
        return $this->presence_oeufs;
    }

    public function setPresenceOeufs(?string $presence_oeufs): self
    {
        $this->presence_oeufs = $presence_oeufs;

        return $this;
    }

    public function getCouvainOpercule(): ?string
    {
        return $this->couvain_opercule;
    }

    public function setCouvainOpercule(?string $couvain_opercule): self
    {
        $this->couvain_opercule = $couvain_opercule;

        return $this;
    }

    public function getEattEssaim(): ?string
    {
        return $this->eatt_essaim;
    }

    public function setEattEssaim(?string $eatt_essaim): self
    {
        $this->eatt_essaim = $eatt_essaim;

        return $this;
    }

    public function getDateReine(): ?\DateTimeInterface
    {
        return $this->date_reine;
    }

    public function setDateReine(?\DateTimeInterface $date_reine): self
    {
        $this->date_reine = $date_reine;

        return $this;
    }

    public function getCellulesRoyales(): ?string
    {
        return $this->cellules_royales;
    }

    public function setCellulesRoyales(?string $cellules_royales): self
    {
        $this->cellules_royales = $cellules_royales;

        return $this;
    }

    public function getRaceReine(): ?string
    {
        return $this->race_reine;
    }

    public function setRaceReine(?string $race_reine): self
    {
        $this->race_reine = $race_reine;

        return $this;
    }

    public function getAgeReine(): ?int
    {
        return $this->age_reine;
    }

    public function setAgeReine(?int $age_reine): self
    {
        $this->age_reine = $age_reine;

        return $this;
    }

    public function getNbCadresMiel(): ?int
    {
        return $this->nb_cadres_miel;
    }

    public function setNbCadresMiel(?int $nb_cadres_miel): self
    {
        $this->nb_cadres_miel = $nb_cadres_miel;

        return $this;
    }

    public function getNbCadresPollen(): ?int
    {
        return $this->nbCadresPollen;
    }

    public function setNbCadresPollen(?int $nbCadresPollen): self
    {
        $this->nbCadresPollen = $nbCadresPollen;

        return $this;
    }

    public function getDateTraitement(): ?\DateTimeInterface
    {
        return $this->date_traitement;
    }

    public function setDateTraitement(?\DateTimeInterface $date_traitement): self
    {
        $this->date_traitement = $date_traitement;

        return $this;
    }

    public function getNatureTraitement(): ?string
    {
        return $this->nature_traitement;
    }

    public function setNatureTraitement(?string $nature_traitement): self
    {
        $this->nature_traitement = $nature_traitement;

        return $this;
    }

    public function getDateNourrissement(): ?\DateTimeInterface
    {
        return $this->dateNourrissement;
    }

    public function setDateNourrissement(?\DateTimeInterface $dateNourrissement): self
    {
        $this->dateNourrissement = $dateNourrissement;

        return $this;
    }

    public function getQttNourrissement(): ?int
    {
        return $this->qttNourrissement;
    }

    public function setQttNourrissement(?int $qttNourrissement): self
    {
        $this->qttNourrissement = $qttNourrissement;

        return $this;
    }

    public function getNatureNourrissement(): ?string
    {
        return $this->natureNourrissement;
    }

    public function setNatureNourrissement(?string $natureNourrissement): self
    {
        $this->natureNourrissement = $natureNourrissement;

        return $this;
    }

    public function getOrigineEssaim(): ?string
    {
        return $this->origineEssaim;
    }

    public function setOrigineEssaim(?string $origineEssaim): self
    {
        $this->origineEssaim = $origineEssaim;

        return $this;
    }

    public function getNbHausseRecoltees(): ?int
    {
        return $this->nbHausseRecoltees;
    }

    public function setNbHausseRecoltees(?int $nbHausseRecoltees): self
    {
        $this->nbHausseRecoltees = $nbHausseRecoltees;

        return $this;
    }

    public function getDateRecolte(): ?\DateTimeInterface
    {
        return $this->dateRecolte;
    }

    public function setDateRecolte(?\DateTimeInterface $dateRecolte): self
    {
        $this->dateRecolte = $dateRecolte;

        return $this;
    }

    public function getNatureMiel(): ?string
    {
        return $this->natureMiel;
    }

    public function setNatureMiel(?string $natureMiel): self
    {
        $this->natureMiel = $natureMiel;

        return $this;
    }

    public function getPresenceVarroa(): ?string
    {
        return $this->presenceVarroa;
    }

    public function setPresenceVarroa(?string $presenceVarroa): self
    {
        $this->presenceVarroa = $presenceVarroa;

        return $this;
    }

    public function getEtatAbeilles(): ?string
    {
        return $this->etatAbeilles;
    }

    public function setEtatAbeilles(?string $etatAbeilles): self
    {
        $this->etatAbeilles = $etatAbeilles;

        return $this;
    }

    public function getDateTranshumance(): ?\DateTimeInterface
    {
        return $this->dateTranshumance;
    }

    public function setDateTranshumance(?\DateTimeInterface $dateTranshumance): self
    {
        $this->dateTranshumance = $dateTranshumance;

        return $this;
    }

    public function getLieuTranshumance(): ?string
    {
        return $this->lieuTranshumance;
    }

    public function setLieuTranshumance(?string $lieuTranshumance): self
    {
        $this->lieuTranshumance = $lieuTranshumance;

        return $this;
    }
}
