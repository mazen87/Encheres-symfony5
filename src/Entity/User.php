<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; 
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(
 *  fields= {"email"},
 *  message= "l'Email est déjà utilisé !"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="ce champ est obligatoire !")
     * @Assert\Length(max=255, maxMessage="maximum 255 caractères !")
     */
    private $username;
     /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="ce champ est obligatoire !")
     * @Assert\Length(max=255, maxMessage="maximum 255 caractères !")
     */
    private $nom;
     /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="ce champ est obligatoire !")
     * @Assert\Length(max=255, maxMessage="maximum 255 caractères !")
     */
    private $prenom;
     /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="ce champ est obligatoire !")
     * @Assert\Length(max=255, maxMessage="maximum 255 caractères !")
     */
    private $adresse;
     /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="ce champ est obligatoire !")
     * @Assert\Length(max=255, maxMessage="maximum 255 caractères !")
     */
    private $password;
     /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="ce champ est obligatoire !")
     * @Assert\Length(max=20, maxMessage="maximum 20 nombres !")
     */
    private $telephone;
     /**
     * @ORM\Column(type="string", length=255 , unique=true)
     * @Assert\NotBlank(message="ce champ est obligatoire !")
     * @Assert\Length(max=255, maxMessage="maximum 255 caractères !")
     * @Assert\Email
     */
    private $email;
     /**
     * @ORM\Column(type="string", length=25)
     * @Assert\Length(max=255, maxMessage="maximum 255 caractères !")
     * 
     */
    private $roles;
     /**
     * @ORM\Column(type="boolean")
     */
    private $active;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Annonce", mappedBy="createur")
     */
    private $annonces;

    /**
     * @ORM\OneToMany(targetEntity=Enchere::class, mappedBy="encherisseur")
     */
    private $encheres;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="envoyeur")
     */
    private $messages_envoyes;

     /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="destinataire")
     */
    private $messages_recus;
    
    public function __construct()
    {
        $this->annonces = new ArrayCollection();
        $this->encheres = new ArrayCollection();
        $this->messages_envoyes = new ArrayCollection();
        $this->messages_recus = new ArrayCollection();
    }

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of adresse
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */ 
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of telephone
     */ 
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @return  self
     */ 
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of roles
     */ 
    public function getRoles()
    {
        return ["ROLE_USER"];
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */ 
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get the value of active
     */ 
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */ 
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        
    }


    /**
     * Get the value of annonces
     */ 
    public function getAnnonces()
    {
        return $this->annonces;
    }

    /**
     * Set the value of annonces
     *
     * @return  self
     */ 
    public function setAnnonces($annonces)
    {
        $this->annonces = $annonces;

        return $this;
    }

    /**
     * @return Collection|Enchere[]
     */
    public function getEncheres(): Collection
    {
        return $this->encheres;
    }

    public function addEnchere(Enchere $enchere): self
    {
        if (!$this->encheres->contains($enchere)) {
            $this->encheres[] = $enchere;
            $enchere->setEncherisseur($this);
        }

        return $this;
    }

    public function removeEnchere(Enchere $enchere): self
    {
        if ($this->encheres->removeElement($enchere)) {
            // set the owning side to null (unless already changed)
            if ($enchere->getEncherisseur() === $this) {
                $enchere->setEncherisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages_envoyes(): Collection
    {
        return $this->messages_envoyes;
    }

    public function addMessage_envoye(Message $message): self
    {
        if (!$this->messages_envoyes->contains($message)) {
            $this->messages_envoyes[] = $message;
            $message->setEnvoyeur($this);
        }

        return $this;
    }

    public function removeMessage_envoye(Message $message): self
    {
        if ($this->messages_envoyes->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getEnvoyeur() === $this) {
                $message->setEnvoyeur(null);
            }
        }

        return $this;
    }


     /**
     * @return Collection|Message[]
     */
    public function getMessages_recus(): Collection
    {
        return $this->messages_recus;
    }

    public function addMessage_recu(Message $message): self
    {
        if (!$this->messages_recus->contains($message)) {
            $this->messages_recus[] = $message;
            $message->setDestinataire($this);
        }

        return $this;
    }

    public function removeMessage_recu(Message $message): self
    {
        if ($this->messages_recus->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getDestinataire() === $this) {
                $message->setDestinataire(null);
            }
        }

        return $this;
    }
}
