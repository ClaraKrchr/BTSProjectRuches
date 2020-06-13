<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssocierRucheApiculteurRepository")
 * @ORM\Table(
 *      name="associer_ruche_apiculteur",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"ruche_id"})}
 * )
 */
class AssocierRucheApiculteur
{

    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="App\Entity\CRuche", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ruche;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\CApiculteur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $apiculteur;

    public function getRuche(): ?CRuche
    {
        return $this->ruche;
    }

    public function setRuche(CRuche $ruche): self
    {
        $this->ruche = $ruche;

        return $this;
    }

    public function getApiculteur(): ?CApiculteur
    {
        return $this->apiculteur;
    }

    public function setApiculteur(?CApiculteur $apiculteur): self
    {
        $this->apiculteur = $apiculteur;

        return $this;
    }
}
