<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CPeseRucheRepository")
 */
class CPeseRuche
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nompeseruche;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateinstall;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visibilite;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AssociationPeserucheStation", mappedBy="peseruche", cascade={"persist", "remove"})
     */
    private $associationPeserucheStation;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AssociationRuchePeseruche", mappedBy="peseruche", cascade={"persist", "remove"})
     */
    private $associationRuchePeseruche;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MesuresRuches", mappedBy="peseruche", orphanRemoval=true)
     */
    private $mesuresRuches;

    public function __construct()
    {
        $this->mesuresRuches = new ArrayCollection();
    }

#============================GETTERS=========================#

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPeseRuche(): ?string
    {
        return $this->nompeseruche;
    }

    public function getDateInstall(): ?\DateTimeInterface
    {
        return $this->dateinstall;
    }

    public function getVisibilite(): ?bool
    {
        return $this->visibilite;
    }

#=========================SETTERS==========================#

    public function setNomPeseRuche(string $nompeseruche): self
    {
        $this->nompeseruche = $nompeseruche;

        return $this;
    }

    public function setDateInstall(?\DateTimeInterface $dateinstall): self
    {
        $this->dateinstall = $dateinstall;

        return $this;
    }

    public function setVisibilite(bool $visibilite): self
    {
        $this->visibilite = $visibilite;

        return $this;
    }

    public function getAssociationPeserucheStation(): ?AssociationPeserucheStation
    {
        return $this->associationPeserucheStation;
    }

    public function setAssociationPeserucheStation(AssociationPeserucheStation $associationPeserucheStation): self
    {
        $this->associationPeserucheStation = $associationPeserucheStation;

        // set the owning side of the relation if necessary
        if ($associationPeserucheStation->getPeseruche() !== $this) {
            $associationPeserucheStation->setPeseruche($this);
        }

        return $this;
    }

    public function getAssociationRuchePeseruche(): ?AssociationRuchePeseruche
    {
        return $this->associationRuchePeseruche;
    }

    public function setAssociationRuchePeseruche(AssociationRuchePeseruche $associationRuchePeseruche): self
    {
        $this->associationRuchePeseruche = $associationRuchePeseruche;

        // set the owning side of the relation if necessary
        if ($associationRuchePeseruche->getPeseruche() !== $this) {
            $associationRuchePeseruche->setPeseruche($this);
        }

        return $this;
    }

    /**
     * @return Collection|MesuresRuches[]
     */
    public function getMesuresRuches(): Collection
    {
        return $this->mesuresRuches;
    }

    public function addMesuresRuch(MesuresRuches $mesuresRuch): self
    {
        if (!$this->mesuresRuches->contains($mesuresRuch)) {
            $this->mesuresRuches[] = $mesuresRuch;
            $mesuresRuch->setPeseruche($this);
        }

        return $this;
    }

    public function removeMesuresRuch(MesuresRuches $mesuresRuch): self
    {
        if ($this->mesuresRuches->contains($mesuresRuch)) {
            $this->mesuresRuches->removeElement($mesuresRuch);
            // set the owning side to null (unless already changed)
            if ($mesuresRuch->getPeseruche() === $this) {
                $mesuresRuch->setPeseruche(null);
            }
        }

        return $this;
    }

}
