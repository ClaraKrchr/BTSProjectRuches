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
    * @ORM\Column(type="string")
    */
    private $nom;

    /**
    * @ORM\Column(type="string")
    */
    private $prenom;

    /**
    * @ORM\Column(type="string")
    * @Assert\Email(message="Veuillez saisir un mail valide")
    */
    private $mail;

    /**
    * @ORM\Column(type="string")
    * @Assert\Length(min="6", minMessage="Votre mdp doit contenir au moins 6 caracteres")
    * @Assert\EqualTo(propertyPath="confirm_password", message="Vous n'avez pas entre le meme mdp")
    */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas entre le meme mdp")
     */
    private $confirm_password;

    /**
    * @ORM\Column(type="string")
    * @Assert\Length(min="10", minMessage="Mauvais format", max="10", maxMessage="Mauvais format")
    */
    private $tel;

    /**
    * @ORM\Column(type="string")
    * @Assert\Length(min="5", minMessage="Mauvais format", max="5", maxMessage="Mauvais format")
    */
    private $codepostal;

    /**
    * @ORM\Column(type="string")
    */
    private $ville;

    /**
    * @ORM\Column(type="string")
    */
    private $postaddr;

    /**
     * @ORM\Column(type="boolean")
     */
    private $typeuser;


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

    public function getCodepostal(): ?string
    {
        return $this->codepostal;
    }

    public function getVille(): ?string
    {
      return $this->ville;
    }

    public function getPostaddr(): ?string
    {
      return $this->postaddr;
    }

    public function getTypeuser(): ?int
    {
        return $this->typeuser;
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

    public function setCodepostal(string $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function setPostaddr(string $postaddr): self
    {
        $this->postaddr = $postaddr;

        return $this;
    }

    public function setTypeuser(int $typeuser): self
    {
        $this->typeuser = $typeuser;

        return $this;
    }

#==================================OTHER FUNCTIONS================================#


    public function __toString(){
        return $this->getNom();
    }

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
