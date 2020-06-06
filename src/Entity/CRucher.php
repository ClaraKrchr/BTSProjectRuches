<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
     * @ORM\Column(type="string", length=30)
     * @Groups("mesureS:read")
     */
    private $nom;
    
    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;
    

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AssociationRucheRucher", mappedBy="rucher")
     */
    private $associationRucheRuchers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AssociationStationRucher", mappedBy="rucher")
     */
    private $associationStationRuchers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MesuresStations", mappedBy="rucher", orphanRemoval=true)
     */
    private $mesuresStations;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AssociationRucherRegion", mappedBy="rucher", cascade={"persist", "remove"})
     */
    private $associationRucherRegion;

    public function __construct()
    {
        $this->associationRucheRuchers = new ArrayCollection();
        $this->associationStationRuchers = new ArrayCollection();
        $this->mesuresStations = new ArrayCollection();
    }

#=======================GETTERS========================#

    public function getId(): ?int
    {
        return $this->id;
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

/**
 * @return Collection|MesuresStations[]
 */
public function getMesuresStations(): Collection
{
    return $this->mesuresStations;
}

public function addMesuresStation(MesuresStations $mesuresStation): self
{
    if (!$this->mesuresStations->contains($mesuresStation)) {
        $this->mesuresStations[] = $mesuresStation;
        $mesuresStation->setRucher($this);
    }

    return $this;
}

public function removeMesuresStation(MesuresStations $mesuresStation): self
{
    if ($this->mesuresStations->contains($mesuresStation)) {
        $this->mesuresStations->removeElement($mesuresStation);
        // set the owning side to null (unless already changed)
        if ($mesuresStation->getRucher() === $this) {
            $mesuresStation->setRucher(null);
        }
    }

    return $this;
}

public function getAssociationRucherRegion(): ?AssociationRucherRegion
{
    return $this->associationRucherRegion;
}

public function setAssociationRucherRegion(AssociationRucherRegion $associationRucherRegion): self
{
    $this->associationRucherRegion = $associationRucherRegion;

    // set the owning side of the relation if necessary
    if ($associationRucherRegion->getRucher() !== $this) {
        $associationRucherRegion->setRucher($this);
    }

    return $this;
}

}
