<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssociationRucheRucherRepository")
 */
class AssociationRucheRucher
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CRuche", inversedBy="associationRucheRucher", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ruche;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CRucher", inversedBy="associationRucheRuchers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rucher;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRuche(): ?CRuche
    {
        return $this->ruche;
    }

    public function setRuche(CRuche $ruche): self
    {
        $this->ruche = $ruche;

        return $this;
    }

    public function getRucher(): ?CRucher
    {
        return $this->rucher;
    }

    public function setRucher(?CRucher $rucher): self
    {
        $this->rucher = $rucher;

        return $this;
    }
}
