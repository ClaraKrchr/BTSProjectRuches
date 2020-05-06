<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MesuresPeseruchesRepository")
 */
class MesuresPeseruches
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\cpeseruche", inversedBy="mesuresPeseruches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $peseruche;

    /**
     * @ORM\Column(type="smallint")
     */
    private $poids;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_releve;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeseruche(): ?cpeseruche
    {
        return $this->peseruche;
    }

    public function setPeseruche(?cpeseruche $peseruche): self
    {
        $this->peseruche = $peseruche;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(int $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getDateReleve(): ?\DateTimeInterface
    {
        return $this->date_releve;
    }

    public function setDateReleve(\DateTimeInterface $date_releve): self
    {
        $this->date_releve = $date_releve;

        return $this;
    }
}
