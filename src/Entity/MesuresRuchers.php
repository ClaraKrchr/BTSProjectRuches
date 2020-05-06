<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MesuresRuchersRepository")
 */
class MesuresRuchers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CRucher", inversedBy="mesuresRuchers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rucher;

    /**
     * @ORM\Column(type="smallint")
     */
    private $temperature;

    /**
     * @ORM\Column(type="smallint")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\CStation", inversedBy="mesuresRuchers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $station;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_releve;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStation(): ?CStation
    {
        return $this->station;
    }

    public function setStation(?CStation $station): self
    {
        $this->station = $station;

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
