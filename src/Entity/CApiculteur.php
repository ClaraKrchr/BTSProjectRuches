<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CApiculteurRepository")
 */
class CApiculteur implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="smallint")
     */
    private $id;

    /**
    * @ORM\Column(type="string", length = 20)
    */
    private $nom;

    /**
    * @ORM\Column(type="string", length = 20)
    */
    private $prenom;

    /**
    * @ORM\Column(type="string")
    */
    private $mail;

    /**
    * @ORM\Column(type="string", length = 255)
    * @Assert\Length(min="8", minMessage="Votre mdp doit contenir au moins 8 caracteres")
    * @Assert\EqualTo(propertyPath="confirm_password", message="Vous n'avez pas entre le meme mdp") 
    */
    private $password;
    
    /**
     * @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas entre le meme mdp")
     */
    private $confirm_password;

    /**
    * @ORM\Column(type="string", length = 10)
    */
    private $tel;

    /**
    * @ORM\Column(type="string", length = 6)
    */
    private $codePostal;

    /**
    * @ORM\Column(type="string")
    */
    private $ville;

    /**
    * @ORM\Column(type="string")
    */
    private $postAddr;

    /**
     * @ORM\Column(type="boolean")
     */
    private $typeUser;
    

#=====================GETTERS==========================#
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
      return $this->nom;
    }

    public function getPrenom(): ?string
    {
      return $this->prenom;
    }

    public function getMail(): ?string
    {
      return $this->mail;
    }
    
    public function getConfirmPassword()
    {
        return $this->confirm_password;
    }

    public function getTel(): ?string
    {
      return $this->tel;
    }

    public function getCodePostal(): ?string
    {
        return $this->$codePostal;
    }

    public function getVille(): ?string
    {
      return $this->ville;
    }

    public function getPostAddr(): ?string
    {
      return $this->postAddr;
    }

    public function getTypeUser(): ?int
    {
        return $this->typeUser;
    }

#==============================SETTERS=========================#

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    
    public function setConfirmPassword($confirm_password) 
    {
        $this->confirm_password = $confirm_password;
        return $this;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->$codePostal = $codePostal;

        return $this;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function setPostAddr(string $postAddr): self
    {
        $this->postAddr = $postAddr;

        return $this;
    }

    public function setTypeUser(int $typeUser): self
    {
        $this->typeUser = $typeUser;

        return $this;
    }

#==================================OTHER FUNCTIONS================================#

 


    public function eraseCredentials()
    {
        
    }
    
    public function getsalt()
    {
        
    }
    
    public function getPassword()
    {
        return $this->password;
        
    }
    
    public function getUsername()
    {
        return $this->mail;
    }
    
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

}
