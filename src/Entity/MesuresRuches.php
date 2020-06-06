<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MesuresRuchesRepository")
 */
class MesuresRuches
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("mesure:read")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CRuche", inversedBy="mesuresRuches")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("mesure:read")
     */
    private $ruche;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     * @Groups("mesure:read")
     * @Assert\NotBlank
     */
    private $poids;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("mesure:read")
     * @Assert\NotBlank
     */
    private $date_releve;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CPeseRuche", inversedBy="mesuresRuches")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("mesure:read")
     */
    private $peseruche;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRuche(): ?CRuche
    {
        return $this->ruche;
    }

    public function setRuche(?CRuche $ruche): self
    {
        $this->ruche = $ruche;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(?int $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getDateReleve(): ?\DateTimeInterface
    {
        return $this->date_releve;
    }

    public function setDateReleve(\DateTimeInterface $date_releve): self
    {
        $this->date_releve = $date_releve;

        return $this;
    }

    public function getPeseruche(): ?CPeseRuche
    {
        return $this->peseruche;
    }

    public function setPeseruche(?CPeseRuche $peseruche): self
    {
        $this->peseruche = $peseruche;

        return $this;
    }
}
