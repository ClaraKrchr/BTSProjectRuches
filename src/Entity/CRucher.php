<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CRucherRepository")
 */
class CRucher
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MesuresRuchers", mappedBy="rucher", orphanRemoval=true)
     */
    private $mesuresRuchers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AssociationRucheRucher", mappedBy="rucher")
     */
    private $associationRucheRuchers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AssociationStationRucher", mappedBy="rucher")
     */
    private $associationStationRuchers;

    public function __construct()
    {
        $this->mesuresRuchers = new ArrayCollection();
        $this->associationRucheRuchers = new ArrayCollection();
        $this->associationStationRuchers = new ArrayCollection();
    }

#=======================GETTERS========================#

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

#========================SETTERS=======================#

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

#=================OTHER========================#
    public function __toString(){
        return $this->getNom();
    }

/**
 * @return Collection|MesuresRuchers[]
 */
public function getMesuresRuchers(): Collection
{
    return $this->mesuresRuchers;
}

public function addMesuresRucher(MesuresRuchers $mesuresRucher): self
{
    if (!$this->mesuresRuchers->contains($mesuresRucher)) {
        $this->mesuresRuchers[] = $mesuresRucher;
        $mesuresRucher->setRucher($this);
    }

    return $this;
}

public function removeMesuresRucher(MesuresRuchers $mesuresRucher): self
{
    if ($this->mesuresRuchers->contains($mesuresRucher)) {
        $this->mesuresRuchers->removeElement($mesuresRucher);
        // set the owning side to null (unless already changed)
        if ($mesuresRucher->getRucher() === $this) {
            $mesuresRucher->setRucher(null);
        }
    }

    return $this;
}

/**
 * @return Collection|AssociationRucheRucher[]
 */
public function getAssociationRucheRuchers(): Collection
{
    return $this->associationRucheRuchers;
}

public function addAssociationRucheRucher(AssociationRucheRucher $associationRucheRucher): self
{
    if (!$this->associationRucheRuchers->contains($associationRucheRucher)) {
        $this->associationRucheRuchers[] = $associationRucheRucher;
        $associationRucheRucher->setRucher($this);
    }

    return $this;
}

public function removeAssociationRucheRucher(AssociationRucheRucher $associationRucheRucher): self
{
    if ($this->associationRucheRuchers->contains($associationRucheRucher)) {
        $this->associationRucheRuchers->removeElement($associationRucheRucher);
        // set the owning side to null (unless already changed)
        if ($associationRucheRucher->getRucher() === $this) {
            $associationRucheRucher->setRucher(null);
        }
    }

    return $this;
}

/**
 * @return Collection|AssociationStationRucher[]
 */
public function getAssociationStationRuchers(): Collection
{
    return $this->associationStationRuchers;
}

public function addAssociationStationRucher(AssociationStationRucher $associationStationRucher): self
{
    if (!$this->associationStationRuchers->contains($associationStationRucher)) {
        $this->associationStationRuchers[] = $associationStationRucher;
        $associationStationRucher->setRucher($this);
    }

    return $this;
}

public function removeAssociationStationRucher(AssociationStationRucher $associationStationRucher): self
{
    if ($this->associationStationRuchers->contains($associationStationRucher)) {
        $this->associationStationRuchers->removeElement($associationStationRucher);
        // set the owning side to null (unless already changed)
        if ($associationStationRucher->getRucher() === $this) {
            $associationStationRucher->setRucher(null);
        }
    }

    return $this;
}

}
