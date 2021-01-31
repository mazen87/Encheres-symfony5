<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; 
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 * @Vich\Uploadable
 */
class Annonce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\Column(type="string", length=255, nullable=true )
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

       /**
     * @ORM\Column(type="datetime",nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string" ,length=255)
     * @Assert\NotBlank(message="ce champ est obligatoire !")
     */
   private $titre;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="ce champ est obligatoire !")
     */
   private $description;
   /**
    * @ORM\Column(type="datetime")
    */
   private $dateCreation;

    /**
    * @ORM\Column(type="datetime",nullable=true )
    */
    private $dateDebutEnchere;
   /**
     * @Assert\Type(type="float" ,message="saisissez des valeurs valides SVP ! ")
     * @ORM\column(type="float",nullable=true)
    */
   private $prixDepart;
   
    /**
     * @Assert\Type(type="float" ,message="saisissez des valeurs valides SVP ! ")
     * @ORM\column(type="float",nullable=true)
    */
   private $prixImmediat;
    /**
     * @Assert\Type(type="float" ,message="saisissez des valeurs valides SVP ! ")
     * @ORM\column(type="float",nullable=true)
    */
   private $prixPropose;
    /**
     * @ORM\Column(type="datetime",nullable=true)
    */
   private $dateFin;
   /**
    * @ORM\Column(type="string" ,length=255, nullable=true)
    */
   private $photo;
   /**
    * @ORM\Column(type="boolean")
    */
   private $disponible;

   
   /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="annonces")
    */
   private $categorie;
   
   
   /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="annonces")
    */
   private $createur;

   /**
    * @ORM\OneToMany(targetEntity=Enchere::class, mappedBy="annonce")
    */
   private $encheres;

   public function __construct()
   {
       $this->encheres = new ArrayCollection();
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
    * Get the value of titre
    */ 
   public function getTitre()
   {
      return $this->titre;
   }

   /**
    * Set the value of titre
    *
    * @return  self
    */ 
   public function setTitre($titre)
   {
      $this->titre = $titre;

      return $this;
   }

   /**
    * Get the value of description
    */ 
   public function getDescription()
   {
      return $this->description;
   }

   /**
    * Set the value of description
    *
    * @return  self
    */ 
   public function setDescription($description)
   {
      $this->description = $description;

      return $this;
   }

   /**
    * Get the value of dateCreation
    */ 
   public function getDateCreation()
   {
      return $this->dateCreation;
   }

   /**
    * Set the value of dateCreation
    *
    * @return  self
    */ 
   public function setDateCreation($dateCreation)
   {
      $this->dateCreation = $dateCreation;

      return $this;
   }

   /**
    * Get the value of prixDepart
    */ 
   public function getPrixDepart()
   {
      return $this->prixDepart;
   }

   /**
    * Set the value of prixDepart
    *
    * @return  self
    */ 
   public function setPrixDepart($prixDepart)
   {
      $this->prixDepart = $prixDepart;

      return $this;
   }

   /**
    * Get the value of prixImmediat
    */ 
   public function getPrixImmediat()
   {
      return $this->prixImmediat;
   }

   /**
    * Set the value of prixImmediat
    *
    * @return  self
    */ 
   public function setPrixImmediat($prixImmediat)
   {
      $this->prixImmediat = $prixImmediat;

      return $this;
   }

   /**
    * Get the value of prixPropose
    */ 
   public function getPrixPropose()
   {
      return $this->prixPropose;
   }

   /**
    * Set the value of prixPropose
    *
    * @return  self
    */ 
   public function setPrixPropose($prixPropose)
   {
      $this->prixPropose = $prixPropose;

      return $this;
   }

   /**
    * Get the value of dateFin
    */ 
   public function getDateFin()
   {
      return $this->dateFin;
   }

   /**
    * Set the value of dateFin
    *
    * @return  self
    */ 
   public function setDateFin($dateFin)
   {
      $this->dateFin = $dateFin;

      return $this;
   }

   /**
    * Get the value of photo
    */ 
   public function getPhoto()
   {
      return $this->photo;
   }

   /**
    * Set the value of photo
    *
    * @return  self
    */ 
   public function setPhoto($photo)
   {
      $this->photo = $photo;

      return $this;
   }

   /**
    * Get the value of disponible
    */ 
   public function getDisponible()
   {
      return $this->disponible;
   }

   /**
    * Set the value of disponible
    *
    * @return  self
    */ 
   public function setDisponible($disponible)
   {
      $this->disponible = $disponible;

      return $this;
   }

   /**
    * Get the value of categorie
    */ 
   public function getCategorie()
   {
      return $this->categorie;
   }

   /**
    * Set the value of categorie
    *
    * @return  self
    */ 
   public function setCategorie($categorie)
   {
      $this->categorie = $categorie;

      return $this;
   }

   /**
    * Get the value of createur
    */ 
   public function getCreateur()
   {
      return $this->createur;
   }

   /**
    * Set the value of createur
    *
    * @return  self
    */ 
   public function setCreateur($createur)
   {
      $this->createur = $createur;

      return $this;
   }

    /**
     * Get the value of image
     *
     * @return  string
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @param  string  $image
     *
     * @return  self
     */ 
    public function setImage(string $image= null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of imageFile
     *
     * @return  File
     */ 
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @param  File  $imageFile
     *
     * @return  self
     */ 
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
        if ($image) {
         // if 'updatedAt' is not defined in your entity, use another property
         $this->updatedAt = new \DateTime('now');
     }

        return $this;
    } 

    /**
     * Get the value of updatedAt
     *
     * @return  \DateTime
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @param  \DateTime  $updatedAt
     *
     * @return  self
     */ 
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

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
            $enchere->setAnnonce($this);
        }

        return $this;
    }

    public function removeEnchere(Enchere $enchere): self
    {
        if ($this->encheres->removeElement($enchere)) {
            // set the owning side to null (unless already changed)
            if ($enchere->getAnnonce() === $this) {
                $enchere->setAnnonce(null);
            }
        }

        return $this;
    }

    /**
     * Get the value of dateDebutEnchere
     */ 
    public function getDateDebutEnchere()
    {
        return $this->dateDebutEnchere;
    }

    /**
     * Set the value of dateDebutEnchere
     *
     * @return  self
     */ 
    public function setDateDebutEnchere($dateDebutEnchere )
    {
        if($dateDebutEnchere === null){
         $this->dateDebutEnchere = $this->dateCreation;
        }
        else{
        $this->dateDebutEnchere = $dateDebutEnchere;
       } 
        return $this;
    }
}
