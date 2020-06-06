<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MesuresStationsRepository")
 */
class MesuresStations
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("mesureS:read")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CStation", inversedBy="mesuresStations")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("mesureS:read")
     */
    private $station;

    /**
     * @ORM\Column(type="smallint")
     * @Groups("mesureS:read")
     */
    private $temperature;

    /**
     * @ORM\Column(type="smallint")
     * @Groups("mesureS:read")
     */
    private $tension;

    /**
     * @ORM\Column(type="smallint")
     * @Groups("mesureS:read")
     */
    private $humidite;

    /**
     * @ORM\Column(type="smallint")
     * @Groups("mesureS:read")
     */
    private $pression;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("mesureS:read")
     */
    private $date_releve;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CRucher", inversedBy="mesuresStations")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("mesureS:read")
     */
    private $rucher;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTemperature(): ?int
    {
        return $this->temperature;
    }

    public function setTemperature(int $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getTension(): ?int
    {
        return $this->tension;
    }

    public function setTension(int $tension): self
    {
        $this->tension = $tension;

        return $this;
    }

    public function getHumidite(): ?int
    {
        return $this->humidite;
    }

    public function setHumidite(int $humidite): self
    {
        $this->humidite = $humidite;

        return $this;
    }

    public function getPression(): ?int
    {
        return $this->pression;
    }

    public function setPression(int $pression): self
    {
        $this->pression = $pression;

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
