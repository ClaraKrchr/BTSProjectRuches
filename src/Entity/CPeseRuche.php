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
     * @ORM\ManyToOne(targetEntity="App\Entity\CApiculteur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $proprietaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CRucher")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rucher;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visibilite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MesuresPeseruches", mappedBy="peseruche_id", orphanRemoval=true)
     */
    private $mesuresPeseruches;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AssociationPeserucheStation", mappedBy="peseruche", cascade={"persist", "remove"})
     */
    private $associationPeserucheStation;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AssociationRuchePeseruche", mappedBy="peseruche", cascade={"persist", "remove"})
     */
    private $associationRuchePeseruche;

    public function __construct()
    {
        $this->mesuresPeseruches = new ArrayCollection();
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

    public function getProprietaire(): ?CApiculteur
    {
        return $this->proprietaire;
    }

    public function getRucher(): ?CRucher
    {
        return $this->rucher;
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

    public function setProprietaire(?CApiculteur $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    public function setRucher(?CRucher $rucher): self
    {
        $this->rucher = $rucher;

        return $this;
    }

    public function setVisibilite(bool $visibilite): self
    {
        $this->visibilite = $visibilite;

        return $this;
    }

    /**
     * @return Collection|MesuresPeseruches[]
     */
    public function getMesuresPeseruches(): Collection
    {
        return $this->mesuresPeseruches;
    }

    public function addMesuresPeseruch(MesuresPeseruches $mesuresPeseruch): self
    {
        if (!$this->mesuresPeseruches->contains($mesuresPeseruch)) {
            $this->mesuresPeseruches[] = $mesuresPeseruch;
            $mesuresPeseruch->setPeserucheId($this);
        }

        return $this;
    }

    public function removeMesuresPeseruch(MesuresPeseruches $mesuresPeseruch): self
    {
        if ($this->mesuresPeseruches->contains($mesuresPeseruch)) {
            $this->mesuresPeseruches->removeElement($mesuresPeseruch);
            // set the owning side to null (unless already changed)
            if ($mesuresPeseruch->getPeserucheId() === $this) {
                $mesuresPeseruch->setPeserucheId(null);
            }
        }

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

}
