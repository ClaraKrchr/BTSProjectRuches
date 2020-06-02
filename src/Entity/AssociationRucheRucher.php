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
     * @ORM\OneToOne(targetEntity="App\Entity\CRuche", inversedBy="associationRucheRucher", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ruche;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\CRucher", inversedBy="associationRucheRuchers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rucher;

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
