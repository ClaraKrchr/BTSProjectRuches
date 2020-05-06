<?php

namespace App\Entity;

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
     * @ORM\OneToOne(targetEntity="App\Entity\CPeseRuche", inversedBy="associationPeserucheStation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $peseruche;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CStation", inversedBy="associationPeserucheStations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $station;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeseruche(): ?CPeseRuche
    {
        return $this->peseruche;
    }

    public function setPeseruche(CPeseRuche $peseruche): self
    {
        $this->peseruche = $peseruche;

        return $this;
    }

    public function getStation(): ?CStation
    {
        return $this->station;
    }

    public function setStation(?CStation $station): self
    {
        $this->station = $station;

        return $this;
    }
}
