<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CRucheRepository")
 */
class CRuche
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
    private $nomruche;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateinstall;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $typeruche;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visibilite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MesuresRuches", mappedBy="ruche_id", orphanRemoval=true)
     */
    private $mesuresRuches;

    public function __construct()
    {
        $this->mesuresRuches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomruche(): ?string
    {
        return $this->nomruche;
    }

    public function setNomruche(string $nomruche): self
    {
        $this->nomruche = $nomruche;

        return $this;
    }

    public function getDateinstall(): ?\DateTimeInterface
    {
        return $this->dateinstall;
    }

    public function setDateinstall(?\DateTimeInterface $dateinstall): self
    {
        $this->dateinstall = $dateinstall;

        return $this;
    }

    public function getTyperuche(): ?string
    {
        return $this->typeruche;
    }

    public function setTyperuche(?string $typeruche): self
    {
        $this->typeruche = $typeruche;

        return $this;
    }

    public function getVisibilite(): ?bool
    {
        return $this->visibilite;
    }

    public function setVisibilite(bool $visibilite): self
    {
        $this->visibilite = $visibilite;

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
            $mesuresRuch->setRucheId($this);
        }

        return $this;
    }

    public function removeMesuresRuch(MesuresRuches $mesuresRuch): self
    {
        if ($this->mesuresRuches->contains($mesuresRuch)) {
            $this->mesuresRuches->removeElement($mesuresRuch);
            // set the owning side to null (unless already changed)
            if ($mesuresRuch->getRucheId() === $this) {
                $mesuresRuch->setRucheId(null);
            }
        }

        return $this;
    }

}
