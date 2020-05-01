<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CApicultureRepository")
 */
class CApiculture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $temperature;
    
    #========================SETTERS================================#
    public function setTemperature(?int $temperature): self
    {
        $this->temperature = $temperature;
        
        return $this;
    }
    #========================GETTERS================================#
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getTemperature(): ?int{
        return $this->temperature;
    }
    
}
