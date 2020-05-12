<?php

namespace App\Entity;

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
     * @ORM\Column(type="string", length=30)
     */
    private $nomregion;

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
