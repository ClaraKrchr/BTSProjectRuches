<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
     * @Groups("mesure:read")
     */
    private $nomruche;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("mesure:read")
     */
    private $dateinstall;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups("mesure:read")
     */
    private $typeruche;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("mesure:read")
     */
    private $visibilite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MesuresRuches", mappedBy="ruche")
     */
    private $mesuresRuches;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AssociationRuchePeseruche", mappedBy="ruche", cascade={"persist", "remove"})
     */
    private $associationRuchePeseruche;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AssociationRucheApiculteur", mappedBy="ruche", cascade={"persist", "remove"})
     */
    private $associationRucheApiculteur;

    /**
     * @ORM\Column(type="smallint")
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Carnet", mappedBy="ruche")
     */
    private $carnets;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datearchive;

    public function __construct()
    {
        $this->mesuresRuches = new ArrayCollection();
        $this->carnets = new ArrayCollection();
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

    public function getAssociationRuchePeseruche(): ?AssociationRuchePeseruche
    {
        return $this->associationRuchePeseruche;
    }

    public function setAssociationRuchePeseruche(AssociationRuchePeseruche $associationRuchePeseruche): self
    {
        $this->associationRuchePeseruche = $associationRuchePeseruche;

        // set the owning side of the relation if necessary
        if ($associationRuchePeseruche->getRuche() !== $this) {
            $associationRuchePeseruche->setRuche($this);
        }

        return $this;
    }

    public function getAssociationRucheApiculteur(): ?AssociationRucheApiculteur
    {
        return $this->associationRucheApiculteur;
    }

    public function setAssociationRucheApiculteur(AssociationRucheApiculteur $associationRucheApiculteur): self
    {
        $this->associationRucheApiculteur = $associationRucheApiculteur;

        // set the owning side of the relation if necessary
        if ($associationRucheApiculteur->getRuche() !== $this) {
            $associationRucheApiculteur->setRuche($this);
        }

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection|Carnet[]
     */
    public function getCarnets(): Collection
    {
        return $this->carnets;
    }

    public function addCarnet(Carnet $carnet): self
    {
        if (!$this->carnets->contains($carnet)) {
            $this->carnets[] = $carnet;
            $carnet->setRuche($this);
        }

        return $this;
    }

    public function removeCarnet(Carnet $carnet): self
    {
        if ($this->carnets->contains($carnet)) {
            $this->carnets->removeElement($carnet);
            // set the owning side to null (unless already changed)
            if ($carnet->getRuche() === $this) {
                $carnet->setRuche(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->getNomRuche();
    }

    public function getDatearchive(): ?\DateTimeInterface
    {
        return $this->datearchive;
    }

    public function setDatearchive(?\DateTimeInterface $datearchive): self
    {
        $this->datearchive = $datearchive;

        return $this;
    }

}
