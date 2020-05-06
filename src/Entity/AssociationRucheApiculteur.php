<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssociationRucheApiculteurRepository")
 */
class AssociationRucheApiculteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CRuche", inversedBy="associationRucheApiculteur", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ruche;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CApiculteur", inversedBy="associationRucheApiculteurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $apiculteur;

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

    public function getApiculteur(): ?CApiculteur
    {
        return $this->apiculteur;
    }

    public function setApiculteur(?CApiculteur $apiculteur): self
    {
        $this->apiculteur = $apiculteur;

        return $this;
    }
}
