<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MesuresRuchesRepository")
 */
class MesuresRuches
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("mesure:read")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups("mesure:read")
     * @Assert\NotBlank
     */
    private $poids;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("mesure:read")
     * @Assert\NotBlank
     */
    private $date_releve;

    /**
     * @ORM\Column(type="integer")
     */
    private $idruche;

    /**
     * @ORM\Column(type="bigint")
     */
    private $idstationport;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(?float $poids): self
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

    public function getIdruche(): ?int
    {
        return $this->idruche;
    }

    public function setIdruche(int $idruche): self
    {
        $this->idruche = $idruche;

        return $this;
    }

    public function getIdstationport(): ?string
    {
        return $this->idstationport;
    }

    public function setIdstationport(string $idstationport): self
    {
        $this->idstationport = $idstationport;

        return $this;
    }
}
