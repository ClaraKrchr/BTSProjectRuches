<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssociationApiculteurCarnetRepository")
 */
class AssociationApiculteurCarnet
{

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\CApiculteur", inversedBy="associationApiculteurCarnets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $apiculteur;

    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="App\Entity\Carnet", inversedBy="associationApiculteurCarnet", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $carnet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApiculteur(): ?CApiculteur
    {
        return $this->apiculteur;
    }

    public function setApiculteur(?CApiculteur $apiculteur): self
    {
        $this->apiculteur = $apiculteur;

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
