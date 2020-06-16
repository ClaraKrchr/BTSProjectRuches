<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionsRepository")
 */
class Regions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, unique=true)
     */
    private $nomregion;


    public function __construct()
    {
        $this->associationRucherRegions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomregion(): ?string
    {
        return $this->nomregion;
    }

    public function setNomregion(string $nomregion): self
    {
        $this->nomregion = $nomregion;

        return $this;
    }

}
