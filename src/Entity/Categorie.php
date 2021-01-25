<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert; 
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 * @UniqueEntity(
 *  fields= {"nom"},
 *  message= "catégorie est déjà utilisé !"
 * )
 */
class Categorie
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
     * @Assert\Unique
     */
    private $nom;
    /**
     * ORM\OneToMany(targetEntity="App\Entity\Annonce", mappedBy="categorie")
     */
    private $annonces;
    public function __construct()
    {
        $this->annonces = new ArrayCollection();
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
     * Get assert\NotBlank(message="ce champ est obligatoire !")
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set assert\NotBlank(message="ce champ est obligatoire !")
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get oRM\OneToMany(targetEntity="App\Entity\Annonce",mappedBy="categorie")
     */ 
    public function getAnnonces()
    {
        return $this->annonces;
    }

    /**
     * Set oRM\OneToMany(targetEntity="App\Entity\Annonce",mappedBy="categorie")
     *
     * @return  self
     */ 
    public function setAnnonces($annonces)
    {
        $this->annonces = $annonces;

        return $this;
    }
}
