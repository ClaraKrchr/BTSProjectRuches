<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActionRepository")
 */
class Action
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
    private $nomaction;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AssociationActionCarnet", mappedBy="action")
     */
    private $associationActionCarnets;

    public function __construct()
    {
        $this->associationActionCarnets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomaction(): ?string
    {
        return $this->nomaction;
    }

    public function setNomaction(string $nomaction): self
    {
        $this->nomaction = $nomaction;

        return $this;
    }

    /**
     * @return Collection|AssociationActionCarnet[]
     */
    public function getAssociationActionCarnets(): Collection
    {
        return $this->associationActionCarnets;
    }

    public function addAssociationActionCarnet(AssociationActionCarnet $associationActionCarnet): self
    {
        if (!$this->associationActionCarnets->contains($associationActionCarnet)) {
            $this->associationActionCarnets[] = $associationActionCarnet;
            $associationActionCarnet->setAction($this);
        }

        return $this;
    }

    public function removeAssociationActionCarnet(AssociationActionCarnet $associationActionCarnet): self
    {
        if ($this->associationActionCarnets->contains($associationActionCarnet)) {
            $this->associationActionCarnets->removeElement($associationActionCarnet);
            // set the owning side to null (unless already changed)
            if ($associationActionCarnet->getAction() === $this) {
                $associationActionCarnet->setAction(null);
            }
        }

        return $this;
    }
}
