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
     * @ORM\OneToMany(targetEntity="App\Entity\AssociationStationRucher", mappedBy="rucher")
     */
    private $associationStationRuchers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Regions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $region;

    public function __construct()
    {
        $this->associationStationRuchers = new ArrayCollection();
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

public function getRegion(): ?Regions
{
    return $this->region;
}

public function setRegion(?Regions $region): self
{
    $this->region = $region;

    return $this;
}


}
