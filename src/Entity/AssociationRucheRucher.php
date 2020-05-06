<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity="App\Entity\CRuche", mappedBy="associationRucheRucher")
     */
    private $ruche;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CRucher", inversedBy="associationRucheRucher", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $rucher;

    public function __construct()
    {
        $this->ruche = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|CRuche[]
     */
    public function getRuche(): Collection
    {
        return $this->ruche;
    }

    public function addRuche(CRuche $ruche): self
    {
        if (!$this->ruche->contains($ruche)) {
            $this->ruche[] = $ruche;
            $ruche->setAssociationRucheRucher($this);
        }

        return $this;
    }

    public function removeRuche(CRuche $ruche): self
    {
        if ($this->ruche->contains($ruche)) {
            $this->ruche->removeElement($ruche);
            // set the owning side to null (unless already changed)
            if ($ruche->getAssociationRucheRucher() === $this) {
                $ruche->setAssociationRucheRucher(null);
            }
        }

        return $this;
    }

    public function getRucher(): ?CRucher
    {
        return $this->rucher;
    }

    public function setRucher(CRucher $rucher): self
    {
        $this->rucher = $rucher;

        return $this;
    }
}
