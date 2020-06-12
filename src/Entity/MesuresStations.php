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
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $temperature;

    /**
     * @ORM\Column(type="float")
     */
    private $tension;

    /**
     * @ORM\Column(type="smallint")
     */
    private $humidite;

    /**
     * @ORM\Column(type="smallint")
     */
    private $pression;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_releve;

    /**
     * @ORM\Column(type="integer")
     */
    private $idrucher;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTension(): ?float
    {
        return $this->tension;
    }

    public function setTension(float $tension): self
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

    public function getIdrucher(): ?int
    {
        return $this->idrucher;
    }

    public function setIdrucher(int $idrucher): self
    {
        $this->idrucher = $idrucher;

        return $this;
    }
}
