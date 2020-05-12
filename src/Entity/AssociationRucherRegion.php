<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssociationRucherRegionRepository")
 */
class AssociationRucherRegion
{

    /**
    * @ORM\Id()
     * @ORM\OneToOne(targetEntity="App\Entity\CRucher", inversedBy="associationRucherRegion", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $rucher;

    /**
    * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Regions", inversedBy="associationRucherRegions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $region;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRegion(): ?Regions
    {
        return $this->region;
    }

    public function setRegion(?Regions $region): self
    {
        $this->region = $region;

        return $this;
    }
}
