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
    private $etatruche;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbcadrescouvain;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $presencemales;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $presencelarves;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $presenceoeufs;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $couvainopercule;

    /**
     * @ORM\Column(type="array", length=25, nullable=true)
     */
    private $etatessaim;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datereine;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $cellulesroyales;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $racereine;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $agereine;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbcadresmiel;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbcadrespollen;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datetraitement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $naturetraitement;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datenourrissement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $qttnourrissement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $naturenourrissement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $origineessaim;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbhausserecoltees;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $daterecolte;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $naturemiel;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $presencevarroa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etatabeilles;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datetranshumance;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $lieutranshumance;


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
        return $this->etatruche;
    }

    public function setEtatRuche(?string $etatruche): self
    {
        $this->etatruche = $etatruche;

        return $this;
    }

    public function getNbCadresCouvain(): ?int
    {
        return $this->nbcadrescouvain;
    }

    public function setNbCadresCouvain(?int $nbcadrescouvain): self
    {
        $this->nbcadrescouvain = $nbcadrescouvain;

        return $this;
    }

    public function getPresenceMales(): ?string
    {
        return $this->presencemales;
    }

    public function setPresenceMales(?string $presencemales): self
    {
        $this->presencemales = $presencemales;

        return $this;
    }

    public function getPresenceLarves(): ?string
    {
        return $this->presencelarves;
    }

    public function setPresenceLarves(?string $presencelarves): self
    {
        $this->presencelarves = $presencelarves;

        return $this;
    }

    public function getPresenceOeufs(): ?string
    {
        return $this->presenceoeufs;
    }

    public function setPresenceOeufs(?string $presenceoeufs): self
    {
        $this->presenceoeufs = $presenceoeufs;

        return $this;
    }

    public function getCouvainOpercule(): ?string
    {
        return $this->couvainopercule;
    }

    public function setCouvainOpercule(?string $couvainopercule): self
    {
        $this->couvainopercule = $couvainopercule;

        return $this;
    }

    public function getEtatEssaim(): ?string
    {
        
        return $this->etatessaim;
    }

    public function setEtatEssaim(?string $etatessaim): self
    {
        $this->etatessaim = $etatessaim;

        return $this;
    }

    public function getDateReine(): ?\DateTimeInterface
    {
        return $this->datereine;
    }

    public function setDateReine(?\DateTimeInterface $datereine): self
    {
        $this->datereine = $datereine;

        return $this;
    }

    public function getCellulesRoyales(): ?string
    {
        return $this->cellulesroyales;
    }

    public function setCellulesRoyales(?string $cellulesroyales): self
    {
        $this->cellulesroyales = $cellulesroyales;

        return $this;
    }

    public function getRaceReine(): ?string
    {
        return $this->racereine;
    }

    public function setRaceReine(?string $racereine): self
    {
        $this->racereine = $racereine;

        return $this;
    }

    public function getAgeReine(): ?int
    {
        return $this->agereine;
    }

    public function setAgeReine(?int $agereine): self
    {
        $this->agereine = $agereine;

        return $this;
    }

    public function getNbCadresMiel(): ?int
    {
        return $this->nbcadresmiel;
    }

    public function setNbCadresMiel(?int $nbcadresmiel): self
    {
        $this->nbcadresmiel = $nbcadresmiel;

        return $this;
    }

    public function getNbCadresPollen(): ?int
    {
        return $this->nbcadrespollen;
    }

    public function setNbCadresPollen(?int $nbcadrespollen): self
    {
        $this->nbcadrespollen = $nbcadrespollen;

        return $this;
    }

    public function getDateTraitement(): ?\DateTimeInterface
    {
        return $this->datetraitement;
    }

    public function setDateTraitement(?\DateTimeInterface $datetraitement): self
    {
        $this->datetraitement = $datetraitement;

        return $this;
    }

    public function getNatureTraitement(): ?string
    {
        return $this->naturetraitement;
    }

    public function setNatureTraitement(?string $naturetraitement): self
    {
        $this->naturetraitement = $naturetraitement;

        return $this;
    }

    public function getDateNourrissement(): ?\DateTimeInterface
    {
        return $this->datenourrissement;
    }

    public function setDateNourrissement(?\DateTimeInterface $datenourrissement): self
    {
        $this->datenourrissement = $datenourrissement;

        return $this;
    }

    public function getQttNourrissement(): ?int
    {
        return $this->qttnourrissement;
    }

    public function setQttNourrissement(?int $qttnourrissement): self
    {
        $this->qttnourrissement = $qttnourrissement;

        return $this;
    }

    public function getNatureNourrissement(): ?string
    {
        return $this->naturenourrissement;
    }

    public function setNatureNourrissement(?string $naturenourrissement): self
    {
        $this->naturenourrissement = $naturenourrissement;

        return $this;
    }

    public function getOrigineEssaim(): ?string
    {
        return $this->origineessaim;
    }

    public function setOrigineEssaim(?string $origineessaim): self
    {
        $this->origineessaim = $origineessaim;

        return $this;
    }

    public function getNbHausseRecoltees(): ?int
    {
        return $this->nbhausserecoltees;
    }

    public function setNbHausseRecoltees(?int $nbhausserecoltees): self
    {
        $this->nbhausserecoltees = $nbhausserecoltees;

        return $this;
    }

    public function getDateRecolte(): ?\DateTimeInterface
    {
        return $this->daterecolte;
    }

    public function setDateRecolte(?\DateTimeInterface $daterecolte): self
    {
        $this->daterecolte = $daterecolte;

        return $this;
    }

    public function getNatureMiel(): ?string
    {
        return $this->naturemiel;
    }

    public function setNatureMiel(?string $naturemiel): self
    {
        $this->naturemiel = $naturemiel;

        return $this;
    }

    public function getPresenceVarroa(): ?string
    {
        return $this->presencevarroa;
    }

    public function setPresenceVarroa(?string $presencevarroa): self
    {
        $this->presencevarroa = $presencevarroa;

        return $this;
    }

    public function getEtatAbeilles(): ?string
    {
        return $this->etatabeilles;
    }

    public function setEtatAbeilles(?string $etatabeilles): self
    {
        $this->etatabeilles = $etatabeilles;

        return $this;
    }

    public function getDateTranshumance(): ?\DateTimeInterface
    {
        return $this->datetranshumance;
    }

    public function setDateTranshumance(?\DateTimeInterface $datetranshumance): self
    {
        $this->datetranshumance = $datetranshumance;

        return $this;
    }

    public function getLieuTranshumance(): ?string
    {
        return $this->lieutranshumance;
    }

    public function setLieuTranshumance(?string $lieutranshumance): self
    {
        $this->lieutranshumance = $lieutranshumance;

        return $this;
    }
}
