<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CStationRepository")
 */
class CStation
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
     * @ORM\OneToMany(targetEntity="App\Entity\MesuresStations", mappedBy="station", orphanRemoval=true)
     */
    private $mesuresStations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MesuresRuchers", mappedBy="station", orphanRemoval=true)
     */
    private $mesuresRuchers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AssociationPeserucheStation", mappedBy="station")
     */
    private $associationPeserucheStations;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AssociationStationRucher", mappedBy="station", cascade={"persist", "remove"})
     */
    private $associationStationRucher;

    public function __construct()
    {
        $this->mesuresStations = new ArrayCollection();
        $this->mesuresRuchers = new ArrayCollection();
        $this->associationPeserucheStations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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
            $mesuresStation->setStation($this);
        }

        return $this;
    }

    public function removeMesuresStation(MesuresStations $mesuresStation): self
    {
        if ($this->mesuresStations->contains($mesuresStation)) {
            $this->mesuresStations->removeElement($mesuresStation);
            // set the owning side to null (unless already changed)
            if ($mesuresStation->getStation() === $this) {
                $mesuresStation->setStation(null);
            }
        }

        return $this;
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
            $mesuresRucher->setStation($this);
        }

        return $this;
    }

    public function removeMesuresRucher(MesuresRuchers $mesuresRucher): self
    {
        if ($this->mesuresRuchers->contains($mesuresRucher)) {
            $this->mesuresRuchers->removeElement($mesuresRucher);
            // set the owning side to null (unless already changed)
            if ($mesuresRucher->getStation() === $this) {
                $mesuresRucher->setStation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AssociationPeserucheStation[]
     */
    public function getAssociationPeserucheStations(): Collection
    {
        return $this->associationPeserucheStations;
    }

    public function addAssociationPeserucheStation(AssociationPeserucheStation $associationPeserucheStation): self
    {
        if (!$this->associationPeserucheStations->contains($associationPeserucheStation)) {
            $this->associationPeserucheStations[] = $associationPeserucheStation;
            $associationPeserucheStation->setStation($this);
        }

        return $this;
    }

    public function removeAssociationPeserucheStation(AssociationPeserucheStation $associationPeserucheStation): self
    {
        if ($this->associationPeserucheStations->contains($associationPeserucheStation)) {
            $this->associationPeserucheStations->removeElement($associationPeserucheStation);
            // set the owning side to null (unless already changed)
            if ($associationPeserucheStation->getStation() === $this) {
                $associationPeserucheStation->setStation(null);
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
        if ($associationStationRucher->getStation() !== $this) {
            $associationStationRucher->setStation($this);
        }

        return $this;
    }

}
