<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CPeseRucheRepository")
 */
class CPeseRuche
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nompeseruche;

    /**
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $poids;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $humiditeinter;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $humiditeexter;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $tempinter;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $tempexter;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $luminosite;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $niveau;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateinstall;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datereleve;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $typeruche;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CApiculteur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $proprietaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CRucher")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rucher;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visibilite;

#============================GETTERS=========================#

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPeseRuche(): ?string
    {
        return $this->nompeseruche;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function getHumiditeInter(): ?int
    {
        return $this->humiditeinter;
    }

    public function getHumiditeExter(): ?int
    {
        return $this->humiditeexter;
    }

    public function getTempInter(): ?int
    {
        return $this->tempinter;
    }

    public function getTempExter(): ?int
    {
        return $this->tempexter;
    }

    public function getLuminosite(): ?int
    {
        return $this->luminosite;
    }

    public function getNivEau(): ?int
    {
        return $this->niveau;
    }

    public function getDateInstall(): ?\DateTimeInterface
    {
        return $this->dateinstall;
    }

    public function getDateReleve(): ?\DateTimeInterface
    {
        return $this->datereleve;
    }

    public function getTypeRuche(): ?string
    {
        return $this->typeruche;
    }

    public function getProprietaire(): ?CApiculteur
    {
        return $this->proprietaire;
    }

    public function getRucher(): ?CRucher
    {
        return $this->rucher;
    }

    public function getVisibilite(): ?bool
    {
        return $this->visibilite;
    }

#=========================SETTERS==========================#

    public function setPoids(?int $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function setNomPeseRuche(string $nompeseruche): self
    {
        $this->nompeseruche = $nompeseruche;

        return $this;
    }

    public function setHumiditeInter(?int $humiditeinter): self
    {
        $this->humiditeinter = $humiditeinter;

        return $this;
    }

    public function setHumiditeExter(?int $humiditeexter): self
    {
        $this->humiditeexter = $humiditeexter;

        return $this;
    }

    public function setTempInter(?int $tempinter): self
    {
        $this->tempinter = $tempinter;

        return $this;
    }

    public function setTempExter(?int $tempexter): self
    {
        $this->tempexter = $tempexter;

        return $this;
    }

    public function setLuminosite(?int $luminosite): self
    {
        $this->luminosite = $luminosite;

        return $this;
    }

    public function setNivEau(?int $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function setDateInstall(?\DateTimeInterface $dateinstall): self
    {
        $this->dateinstall = $dateinstall;

        return $this;
    }

    public function setDateReleve(?\DateTimeInterface $datereleve): self
    {
        $this->datereleve = $datereleve;

        return $this;
    }

    public function setTypeRuche(?string $typeruche): self
    {
        $this->typeruche = $typeruche;

        return $this;
    }

    public function setProprietaire(?CApiculteur $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    public function setRucher(?CRucher $rucher): self
    {
        $this->rucher = $rucher;

        return $this;
    }

    public function setVisibilite(bool $visibilite): self
    {
        $this->visibilite = $visibilite;

        return $this;
    }
}
