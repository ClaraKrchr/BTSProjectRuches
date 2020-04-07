<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CPeseRucheRepository")
 */
class CPeseRuche
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
    private $nom_peseRuche;

    /**
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $poids;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPeseRuche(): ?string
    {
        return $this->nom_peseRuche;
    }

    public function setNomPeseRuche(string $nom_peseRuche): self
    {
        $this->nom_peseRuche = $nom_peseRuche;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(?int $poids): self
    {
        $this->poids = $poids;

        return $this;
    }
}
