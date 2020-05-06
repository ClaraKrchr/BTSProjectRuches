<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssociationPeserucheStationRepository")
 */
class AssociationPeserucheStation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CPeseRuche", mappedBy="associationPeserucheStation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $peseruche;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CStation", inversedBy="associationPeserucheStation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $station;

    public function __construct()
    {
        $this->peseruche = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|CPeseRuche[]
     */
    public function getPeseruche(): Collection
    {
        return $this->peseruche;
    }

    public function addPeseruche(CPeseRuche $peseruche): self
    {
        if (!$this->peseruche->contains($peseruche)) {
            $this->peseruche[] = $peseruche;
            $peseruche->setAssociationPeserucheStation($this);
        }

        return $this;
    }

    public function removePeseruche(CPeseRuche $peseruche): self
    {
        if ($this->peseruche->contains($peseruche)) {
            $this->peseruche->removeElement($peseruche);
            // set the owning side to null (unless already changed)
            if ($peseruche->getAssociationPeserucheStation() === $this) {
                $peseruche->setAssociationPeserucheStation(null);
            }
        }

        return $this;
    }

    public function getStation(): ?CStation
    {
        return $this->station;
    }

    public function setStation(CStation $station): self
    {
        $this->station = $station;

        return $this;
    }
}
