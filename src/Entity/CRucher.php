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
    private $localisation;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $nb_ruches;

#=======================GETTERS========================#

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function getNbRuches(): ?int
    {
        return $this->nb_ruches;
    }

#========================SETTERS=======================#

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function setNbRuches(?int $nb_ruches): self
    {
        $this->nb_ruches = $nb_ruches;

        return $this;
    }
}
