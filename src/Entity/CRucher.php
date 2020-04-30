<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CRucherRepository")
 */
class CRucher
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $nbruches;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

#=======================GETTERS========================#

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function getNbRuches(): ?int
    {
        return $this->nbruches;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

#========================SETTERS=======================#

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function setNbRuches(?int $nbruches): self
    {
        $this->nbruches = $nbruches;

        return $this;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
    
#=================OTHER========================#
    public function __toString(){
        return $this->getNom();
    }
}
