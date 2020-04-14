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
    private $nom_peseRuche;

    /**
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $poids;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $humidite_inter;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $humidite_exter;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $temp_inter;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $temp_exter;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $luminosite;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $niv_eau;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_install;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_releve;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $type_ruche;

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
        return $this->nom_peseRuche;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function getHumiditeInter(): ?int
    {
        return $this->humidite_inter;
    }

    public function getHumiditeExter(): ?int
    {
        return $this->humidite_exter;
    }

    public function getTempInter(): ?int
    {
        return $this->temp_inter;
    }

    public function getTempExter(): ?int
    {
        return $this->temp_exter;
    }

    public function getLuminosite(): ?int
    {
        return $this->luminosite;
    }

    public function getNivEau(): ?int
    {
        return $this->niv_eau;
    }

    public function getDateInstall(): ?\DateTimeInterface
    {
        return $this->date_install;
    }

    public function getDateReleve(): ?\DateTimeInterface
    {
        return $this->date_releve;
    }

    public function getTypeRuche(): ?string
    {
        return $this->type_ruche;
    }

    public function getProprietaire(): ?CApiculteur
    {
        return $this->proprietaire;
    }

    public function getRucher(): ?CRucher
    {
        return $this->rucher;
    }

#=========================SETTERS==========================#

    public function setPoids(?int $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function setNomPeseRuche(string $nom_peseRuche): self
    {
        $this->nom_peseRuche = $nom_peseRuche;

        return $this;
    }

    public function setHumiditeInter(?int $humidite_inter): self
    {
        $this->humidite_inter = $humidite_inter;

        return $this;
    }

    public function setHumiditeExter(?int $humidite_exter): self
    {
        $this->humidite_exter = $humidite_exter;

        return $this;
    }

    public function setTempInter(?int $temp_inter): self
    {
        $this->temp_inter = $temp_inter;

        return $this;
    }

    public function setTempExter(?int $temp_exter): self
    {
        $this->temp_exter = $temp_exter;

        return $this;
    }

    public function setLuminosite(?int $luminosite): self
    {
        $this->luminosite = $luminosite;

        return $this;
    }

    public function setNivEau(?int $niv_eau): self
    {
        $this->niv_eau = $niv_eau;

        return $this;
    }

    public function setDateInstall(?\DateTimeInterface $date_install): self
    {
        $this->date_install = $date_install;

        return $this;
    }

    public function setDateReleve(?\DateTimeInterface $date_releve): self
    {
        $this->date_releve = $date_releve;

        return $this;
    }

    public function setTypeRuche(?string $type_ruche): self
    {
        $this->type_ruche = $type_ruche;

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

    public function getVisibilite(): ?bool
    {
        return $this->visibilite;
    }

    public function setVisibilite(bool $visibilite): self
    {
        $this->visibilite = $visibilite;

        return $this;
    }
}
