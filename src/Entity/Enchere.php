<?php

namespace App\Entity;

use App\Repository\EnchereRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnchereRepository::class)
 */
class Enchere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateEnchere;

    /**
     * @ORM\ManyToOne(targetEntity=Annonce::class, inversedBy="encheres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annonce;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="encheres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $encherisseur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateEnchere(): ?\DateTimeInterface
    {
        return $this->dateEnchere;
    }

    public function setDateEnchere(\DateTimeInterface $dateEnchere): self
    {
        $this->dateEnchere = $dateEnchere;

        return $this;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(?Annonce $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }

    public function getEncherisseur(): ?User
    {
        return $this->encherisseur;
    }

    public function setEncherisseur(?User $encherisseur): self
    {
        $this->encherisseur = $encherisseur;

        return $this;
    }
}
