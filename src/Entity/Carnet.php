<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarnetRepository")
 */
class Carnet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AssociationRucheCarnet", mappedBy="carnet", cascade={"persist", "remove"})
     */
    private $associationRucheCarnet;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AssociationActionCarnet", mappedBy="carnet", cascade={"persist", "remove"})
     */
    private $associationActionCarnet;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AssociationApiculteurCarnet", mappedBy="carnet", cascade={"persist", "remove"})
     */
    private $associationApiculteurCarnet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAssociationRucheCarnet(): ?AssociationRucheCarnet
    {
        return $this->associationRucheCarnet;
    }

    public function setAssociationRucheCarnet(AssociationRucheCarnet $associationRucheCarnet): self
    {
        $this->associationRucheCarnet = $associationRucheCarnet;

        // set the owning side of the relation if necessary
        if ($associationRucheCarnet->getCarnet() !== $this) {
            $associationRucheCarnet->setCarnet($this);
        }

        return $this;
    }

    public function getAssociationActionCarnet(): ?AssociationActionCarnet
    {
        return $this->associationActionCarnet;
    }

    public function setAssociationActionCarnet(AssociationActionCarnet $associationActionCarnet): self
    {
        $this->associationActionCarnet = $associationActionCarnet;

        // set the owning side of the relation if necessary
        if ($associationActionCarnet->getCarnet() !== $this) {
            $associationActionCarnet->setCarnet($this);
        }

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getAssociationApiculteurCarnet(): ?AssociationApiculteurCarnet
    {
        return $this->associationApiculteurCarnet;
    }

    public function setAssociationApiculteurCarnet(AssociationApiculteurCarnet $associationApiculteurCarnet): self
    {
        $this->associationApiculteurCarnet = $associationApiculteurCarnet;

        // set the owning side of the relation if necessary
        if ($associationApiculteurCarnet->getCarnet() !== $this) {
            $associationApiculteurCarnet->setCarnet($this);
        }

        return $this;
    }
}
