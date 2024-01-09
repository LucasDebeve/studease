<?php

namespace App\Entity;

use App\Repository\InsertionProfessionnelleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: InsertionProfessionnelleRepository::class)]
class InsertionProfessionnelle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDeb = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFin = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $descInsPro = null;

    #[Assert\Length(max: 1)]
    #[ORM\Column(nullable: true)]
    private ?bool $teletravail = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 5000)]
    #[ORM\Column(length: 5000)]
    private ?string $titre = null;

    #[ORM\Column(nullable: true)]
    private ?float $revenus = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 6)]
    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $typePro = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\ManyToOne(inversedBy: 'InsertionsProfessionnelles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $company = null;

    #[ORM\OneToMany(mappedBy: 'insertion_professionnelle', targetEntity: Candidature::class, orphanRemoval: true)]
    private Collection $candidatures;

    public function __construct()
    {
        $this->candidatures = new ArrayCollection();
    }

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

    public function getRevenus(): ?float
    {
        return $this->revenus;
    }

    public function setRevenus(?float $revenus): static
    {
        $this->revenus = $revenus;

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
        return $this->company;
    }

    public function setCompany(?User $Company): static
    {
        $this->company = $Company;

        return $this;
    }

    /**
     * @return Collection<int, Candidature>
     */
    public function getCandidatures(): Collection
    {
        return $this->candidatures;
    }

    public function addCandidature(Candidature $candidature): static
    {
        if (!$this->candidatures->contains($candidature)) {
            $this->candidatures->add($candidature);
            $candidature->setInsertionProfessionnelle($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): static
    {
        if ($this->candidatures->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getInsertionProfessionnelle() === $this) {
                $candidature->setInsertionProfessionnelle(null);
            }
        }

        return $this;
    }
}
