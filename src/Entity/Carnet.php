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
     * @ORM\Column(type="string", length=7, nullable=true)
     */
    private $etatRuche;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbCadresCouvain;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $presenceMales;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $presenceLarves;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $presenceOeufs;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $couvainOpercule;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $etatEssaim;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateReine;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $cellulesRoyales;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $raceReine;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ageReine;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbCadresMiel;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbCadresPollen;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateTraitement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $natureTraitement;

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

    public function getEtatRuche(): ?string
    {
        return $this->etatRuche;
    }

    public function setEtatRuche(?string $etatRuche): self
    {
        $this->etatRuche = $etatRuche;

        return $this;
    }

    public function getNbCadresCouvain(): ?int
    {
        return $this->nbCadresCouvain;
    }

    public function setNbCadresCouvain(?int $nbCadresCouvain): self
    {
        $this->nbCadresCouvain = $nbCadresCouvain;

        return $this;
    }

    public function getPresenceMales(): ?string
    {
        return $this->presenceMales;
    }

    public function setPresenceMales(?string $presenceMales): self
    {
        $this->presenceMales = $presenceMales;

        return $this;
    }

    public function getPresenceLarves(): ?string
    {
        return $this->presenceLarves;
    }

    public function setPresenceLarves(?string $presenceLarves): self
    {
        $this->presenceLarves = $presenceLarves;

        return $this;
    }

    public function getPresenceOeufs(): ?string
    {
        return $this->presenceOeufs;
    }

    public function setPresenceOeufs(?string $presenceOeufs): self
    {
        $this->presenceOeufs = $presenceOeufs;

        return $this;
    }

    public function getCouvainOpercule(): ?string
    {
        return $this->couvainOpercule;
    }

    public function setCouvainOpercule(?string $couvainOpercule): self
    {
        $this->couvainOpercule = $couvainOpercule;

        return $this;
    }

    public function getEtatEssaim(): ?string
    {
        return $this->etatEssaim;
    }

    public function setEtatEssaim(?string $etatEssaim): self
    {
        $this->etatEssaim = $etatEssaim;

        return $this;
    }

    public function getDateReine(): ?\DateTimeInterface
    {
        return $this->dateReine;
    }

    public function setDateReine(?\DateTimeInterface $dateReine): self
    {
        $this->dateReine = $dateReine;

        return $this;
    }

    public function getCellulesRoyales(): ?string
    {
        return $this->cellulesRoyales;
    }

    public function setCellulesRoyales(?string $cellulesRoyales): self
    {
        $this->cellulesRoyales = $cellulesRoyales;

        return $this;
    }

    public function getRaceReine(): ?string
    {
        return $this->raceReine;
    }

    public function setRaceReine(?string $raceReine): self
    {
        $this->raceReine = $raceReine;

        return $this;
    }

    public function getAgeReine(): ?int
    {
        return $this->ageReine;
    }

    public function setAgeReine(?int $ageReine): self
    {
        $this->ageReine = $ageReine;

        return $this;
    }

    public function getNbCadresMiel(): ?int
    {
        return $this->nbCadresMiel;
    }

    public function setNbCadresMiel(?int $nbCadresMiel): self
    {
        $this->nbCadresMiel = $nbCadresMiel;

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
