<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssociationActionCarnetRepository")
 */
class AssociationActionCarnet
{

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Action", inversedBy="associationActionCarnets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $action;

    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="App\Entity\Carnet", inversedBy="associationActionCarnet", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $carnet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAction(): ?Action
    {
        return $this->action;
    }

    public function setAction(?Action $action): self
    {
        $this->action = $action;

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
