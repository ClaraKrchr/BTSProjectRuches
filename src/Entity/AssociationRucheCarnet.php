<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssociationRucheCarnetRepository")
 */
class AssociationRucheCarnet
{

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\CRuche", inversedBy="associationRucheCarnets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ruche;

    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="App\Entity\Carnet", inversedBy="associationRucheCarnet", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $carnet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRuche(): ?CRuche
    {
        return $this->ruche;
    }

    public function setRuche(?CRuche $ruche): self
    {
        $this->ruche = $ruche;

        return $this;
    }

    public function getCarnet(): ?Carnet
    {
        return $this->carnet;
    }

    public function setCarnet(Carnet $carnet): self
    {
        $this->carnet = $carnet;

        return $this;
    }
}
