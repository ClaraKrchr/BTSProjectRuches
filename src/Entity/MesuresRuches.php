<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MesuresRuchesRepository")
 */
class MesuresRuches
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CRuche", inversedBy="mesuresRuches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ruche_id;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $poids;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRucheId(): ?CRuche
    {
        return $this->ruche_id;
    }

    public function setRucheId(?CRuche $ruche_id): self
    {
        $this->ruche_id = $ruche_id;

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
