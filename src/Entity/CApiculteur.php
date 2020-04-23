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
    private $mdp;
    
    /**
     * @Assert\EqualTo(propertyPath="mdp", message="Vous n'avez pas entre le meme mdp")
     */
    private $confirm_password;

    /**
    * @ORM\Column(type="string", length = 10)
    */
    private $tel;

    /**
    * @ORM\Column(type="string", length = 6)
    */
    private $code_postal;

    /**
    * @ORM\Column(type="string")
    */
    private $ville;

    /**
    * @ORM\Column(type="string")
    */
    private $post_addr;

    /**
     * @ORM\Column(type="boolean")
     */
    private $type_user;

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

    public function getMdp(): ?string
    {
      return $this->mdp;
    }
    
    public function getConfirmPassword()
    {
        return $this->confirm_password;
    }

    public function getTel(): ?string
    {
      return $this->tel;
    }

    public function getCode_postal(): ?string
    {
      return $this->code_postal;
    }

    public function getVille(): ?string
    {
      return $this->ville;
    }

    public function getPost_addr(): ?string
    {
      return $this->post_addr;
    }

    public function getType_user(): ?int
    {
        return $this->type_user;
    }

#==============================SETTERS=========================#

    public function setName(string $nom): self
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

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

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

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function setPostAddr(string $post_addr): self
    {
        $this->post_addr = $post_addr;

        return $this;
    }

    public function setTypeUser(int $type_user): self
    {
        $this->type_user = $type_user;

        return $this;
    }

#==================================OTHER FUNCTIONS================================#

    public function EditApi(string $newName, string $newPrenom, string $newMail, string $newMdp, string $newTel, string $newCodePostal, string $newVille, string $newAddr): ?int{
      try{
        if ($newNom != "") $nom = $newNom;
        if ($newPrenom != "") $prenom = $newPrenom;
        if ($newMail != "") $mail = $newMail;
        if ($newMdp != "") $mdp = $newMdp;
        if ($newTel != "") $tel = $newTel;
        if ($newCodePostal != "") $code_postal = $newCodePostal;
        if ($newVille != "") $ville = $newVille;
        if ($newAddr != "") $post_addr = $newAddr;
        return 1;
      } catch (Exception $e){ return 0; }
    }

    public function Connexion(): ?int{

    }

    public function Deconnexion(): ?int{

    }
    
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }
    /**
    * @see UserInterface
    */
    public function getPassword()
    {
        // not needed for apps that do not check user passwords
        //return $this->mdp;
    }
    /**
    * @see UserInterface
    */
    public function getSalt()
    {
        // not needed for apps that do not check user passwords
    }
    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

}
