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
     * @ORM\Column(type="string", length=30, unique=true)
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

    /**
     * @ORM\Column(type="smallint")
     */
    private $nbassosrucher;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nbassosport;

    public function __construct()
    {
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

    public function getNbassosrucher(): ?int
    {
        return $this->nbassosrucher;
    }

    public function setNbassosrucher(int $nbassosrucher): self
    {
        $this->nbassosrucher = $nbassosrucher;

        return $this;
    }

    public function getNbassosport(): ?int
    {
        return $this->nbassosport;
    }

    public function setNbassosport(int $nbassosport): self
    {
        $this->nbassosport = $nbassosport;

        return $this;
    }

}
