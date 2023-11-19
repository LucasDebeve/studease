<?php

namespace App\Entity;

use App\Repository\InsertionProfessionnelleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InsertionProfessionnelleRepository::class)]
class InsertionProfessionnelle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDeb = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descInsPro = null;

    #[ORM\Column(nullable: true)]
    private ?bool $teletravail = null;

    #[ORM\Column(length: 50)]
    private ?string $titre = null;

    #[ORM\Column(nullable: true)]
    private ?float $gratification = null;

    #[ORM\Column(nullable: true)]
    private ?float $salaire = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $typePro = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\ManyToOne(inversedBy: 'InsertionsProfessionnelles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Company = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(\DateTimeInterface $dateDeb): static
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDescInsPro(): ?string
    {
        return $this->descInsPro;
    }

    public function setDescInsPro(string $descInsPro): static
    {
        $this->descInsPro = $descInsPro;

        return $this;
    }

    public function isTeletravail(): ?bool
    {
        return $this->teletravail;
    }

    public function setTeletravail(?bool $teletravail): static
    {
        $this->teletravail = $teletravail;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getGratification(): ?float
    {
        return $this->gratification;
    }

    public function setGratification(?float $gratification): static
    {
        $this->gratification = $gratification;

        return $this;
    }

    public function getSalaire(): ?float
    {
        return $this->salaire;
    }

    public function setSalaire(?float $salaire): static
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getTypePro(): ?int
    {
        return $this->typePro;
    }

    public function setTypePro(?int $typePro): static
    {
        $this->typePro = $typePro;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getCompany(): ?User
    {
        return $this->Company;
    }

    public function setCompany(?User $Company): static
    {
        $this->Company = $Company;

        return $this;
    }
}
