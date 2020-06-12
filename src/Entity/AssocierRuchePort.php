<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssocierRuchePortRepository")
 */
class AssocierRuchePort
{

    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="App\Entity\CRuche", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ruche;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\CStation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $station;

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $numport;

    public function getRuche(): ?CRuche
    {
        return $this->ruche;
    }

    public function setRuche(CRuche $ruche): self
    {
        $this->ruche = $ruche;

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

    public function getNumport(): ?int
    {
        return $this->numport;
    }

    public function setNumport(int $numport): self
    {
        $this->numport = $numport;

        return $this;
    }
}
