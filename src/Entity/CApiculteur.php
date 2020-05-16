<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\doctrine\Validator\Constraints\UniqueEntity;

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
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AssociationRucheApiculteur", mappedBy="apiculteur")
     */
    private $associationRucheApiculteurs;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $pseudo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AssociationApiculteurCarnet", mappedBy="apiculteur")
     */
    private $associationApiculteurCarnets;

    public function __construct()
    {
        $this->associationRucheApiculteurs = new ArrayCollection();
        $this->associationApiculteurCarnets = new ArrayCollection();
    }


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

    public function getRoles(): array
    {
        $roles = $this->roles;

        //garantit que chaque utilisateur poss�de le rose USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection|AssociationRucheApiculteur[]
     */
    public function getAssociationRucheApiculteurs(): Collection
    {
        return $this->associationRucheApiculteurs;
    }

    public function addAssociationRucheApiculteur(AssociationRucheApiculteur $associationRucheApiculteur): self
    {
        if (!$this->associationRucheApiculteurs->contains($associationRucheApiculteur)) {
            $this->associationRucheApiculteurs[] = $associationRucheApiculteur;
            $associationRucheApiculteur->setApiculteur($this);
        }

        return $this;
    }

    public function removeAssociationRucheApiculteur(AssociationRucheApiculteur $associationRucheApiculteur): self
    {
        if ($this->associationRucheApiculteurs->contains($associationRucheApiculteur)) {
            $this->associationRucheApiculteurs->removeElement($associationRucheApiculteur);
            // set the owning side to null (unless already changed)
            if ($associationRucheApiculteur->getApiculteur() === $this) {
                $associationRucheApiculteur->setApiculteur(null);
            }
        }

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * @return Collection|AssociationApiculteurCarnet[]
     */
    public function getAssociationApiculteurCarnets(): Collection
    {
        return $this->associationApiculteurCarnets;
    }

    public function addAssociationApiculteurCarnet(AssociationApiculteurCarnet $associationApiculteurCarnet): self
    {
        if (!$this->associationApiculteurCarnets->contains($associationApiculteurCarnet)) {
            $this->associationApiculteurCarnets[] = $associationApiculteurCarnet;
            $associationApiculteurCarnet->setApiculteur($this);
        }

        return $this;
    }

    public function removeAssociationApiculteurCarnet(AssociationApiculteurCarnet $associationApiculteurCarnet): self
    {
        if ($this->associationApiculteurCarnets->contains($associationApiculteurCarnet)) {
            $this->associationApiculteurCarnets->removeElement($associationApiculteurCarnet);
            // set the owning side to null (unless already changed)
            if ($associationApiculteurCarnet->getApiculteur() === $this) {
                $associationApiculteurCarnet->setApiculteur(null);
            }
        }

        return $this;
    }

}
