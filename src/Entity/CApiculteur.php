<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CApiculteurRepository")
 */
class CApiculteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="smallint")
     */
    private $idApi;

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
    * @ORM\Column(type="string", length = 30)
    */
    private $mdp;

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
        return $this->idApi;
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

}
