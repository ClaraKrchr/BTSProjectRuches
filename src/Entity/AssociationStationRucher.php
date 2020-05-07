<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssociationStationRucherRepository")
 */
class AssociationStationRucher
{

    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="App\Entity\CStation", inversedBy="associationStationRucher", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $station;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\CRucher", inversedBy="associationStationRuchers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rucher;

    public function getStation(): ?CStation
    {
        return $this->station;
    }

    public function setStation(CStation $station): self
    {
        $this->station = $station;

        return $this;
    }

    public function getRucher(): ?CRucher
    {
        return $this->rucher;
    }

    public function setRucher(?CRucher $rucher): self
    {
        $this->rucher = $rucher;

        return $this;
    }
}
