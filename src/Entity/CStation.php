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

    public function __construct()
    {
        $this->mesuresStations = new ArrayCollection();
        $this->mesuresRuchers = new ArrayCollection();
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

}
