<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionsRepository")
 */
class Regions
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
    private $nomregion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CRucher", mappedBy="region")
     */
    private $cRuchers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AssociationRucherRegion", mappedBy="region")
     */
    private $associationRucherRegions;

    public function __construct()
    {
        $this->cRuchers = new ArrayCollection();
        $this->associationRucherRegions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomregion(): ?string
    {
        return $this->nomregion;
    }

    public function setNomregion(string $nomregion): self
    {
        $this->nomregion = $nomregion;

        return $this;
    }

    /**
     * @return Collection|CRucher[]
     */
    public function getCRuchers(): Collection
    {
        return $this->cRuchers;
    }

    public function addCRucher(CRucher $cRucher): self
    {
        if (!$this->cRuchers->contains($cRucher)) {
            $this->cRuchers[] = $cRucher;
            $cRucher->setRegion($this);
        }

        return $this;
    }

    public function removeCRucher(CRucher $cRucher): self
    {
        if ($this->cRuchers->contains($cRucher)) {
            $this->cRuchers->removeElement($cRucher);
            // set the owning side to null (unless already changed)
            if ($cRucher->getRegion() === $this) {
                $cRucher->setRegion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AssociationRucherRegion[]
     */
    public function getAssociationRucherRegions(): Collection
    {
        return $this->associationRucherRegions;
    }

    public function addAssociationRucherRegion(AssociationRucherRegion $associationRucherRegion): self
    {
        if (!$this->associationRucherRegions->contains($associationRucherRegion)) {
            $this->associationRucherRegions[] = $associationRucherRegion;
            $associationRucherRegion->setRegion($this);
        }

        return $this;
    }

    public function removeAssociationRucherRegion(AssociationRucherRegion $associationRucherRegion): self
    {
        if ($this->associationRucherRegions->contains($associationRucherRegion)) {
            $this->associationRucherRegions->removeElement($associationRucherRegion);
            // set the owning side to null (unless already changed)
            if ($associationRucherRegion->getRegion() === $this) {
                $associationRucherRegion->setRegion(null);
            }
        }

        return $this;
    }
}
