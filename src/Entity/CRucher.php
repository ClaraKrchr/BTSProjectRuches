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
     * @ORM\OneToOne(targetEntity="App\Entity\AssociationStationRucher", mappedBy="rucher", cascade={"persist", "remove"})
     */
    private $associationStationRucher;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AssociationRucheRucher", mappedBy="rucher", cascade={"persist", "remove"})
     */
    private $associationRucheRucher;

    public function __construct()
    {
        $this->mesuresRuchers = new ArrayCollection();
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

public function getAssociationStationRucher(): ?AssociationStationRucher
{
    return $this->associationStationRucher;
}

public function setAssociationStationRucher(AssociationStationRucher $associationStationRucher): self
{
    $this->associationStationRucher = $associationStationRucher;

    // set the owning side of the relation if necessary
    if ($associationStationRucher->getRucher() !== $this) {
        $associationStationRucher->setRucher($this);
    }

    return $this;
}

public function getAssociationRucheRucher(): ?AssociationRucheRucher
{
    return $this->associationRucheRucher;
}

public function setAssociationRucheRucher(AssociationRucheRucher $associationRucheRucher): self
{
    $this->associationRucheRucher = $associationRucheRucher;

    // set the owning side of the relation if necessary
    if ($associationRucheRucher->getRucher() !== $this) {
        $associationRucheRucher->setRucher($this);
    }

    return $this;
}
}
