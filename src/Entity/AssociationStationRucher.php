<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssociationStationRucherRepository")
 */
class AssociationStationRucher
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CStation", mappedBy="associationStationRucher")
     */
    private $station;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CRucher", inversedBy="associationStationRucher", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $rucher;

    public function __construct()
    {
        $this->station = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|CStation[]
     */
    public function getStation(): Collection
    {
        return $this->station;
    }

    public function addStation(CStation $station): self
    {
        if (!$this->station->contains($station)) {
            $this->station[] = $station;
            $station->setAssociationStationRucher($this);
        }

        return $this;
    }

    public function removeStation(CStation $station): self
    {
        if ($this->station->contains($station)) {
            $this->station->removeElement($station);
            // set the owning side to null (unless already changed)
            if ($station->getAssociationStationRucher() === $this) {
                $station->setAssociationStationRucher(null);
            }
        }

        return $this;
    }

    public function getRucher(): ?CRucher
    {
        return $this->rucher;
    }

    public function setRucher(CRucher $rucher): self
    {
        $this->rucher = $rucher;

        return $this;
    }
}
