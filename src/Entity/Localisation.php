<?php

namespace App\Entity;

use App\Repository\LocalisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocalisationRepository::class)]
class Localisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 140)]
    private ?string $adresse = null;

    #[ORM\Column(length: 6)]
    private ?string $code_postal = null;

    #[ORM\Column(length: 50)]
    private ?string $ville = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?float $longitude = null;

    #[ORM\Column(length: 50)]
    private ?string $pays = null;

    #[ORM\ManyToOne(inversedBy: 'localisations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $entreprise = null;

    #[ORM\OneToMany(mappedBy: 'localisation', targetEntity: InsertionProfessionnelle::class, orphanRemoval: true)]
    private Collection $insertionProfessionnelles;

    public function __construct()
    {
        $this->insertionProfessionnelles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getEntreprise(): ?User
    {
        return $this->entreprise;
    }

    public function setEntreprise(?User $entreprise): static
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * @return Collection<int, InsertionProfessionnelle>
     */
    public function getInsertionProfessionnelles(): Collection
    {
        return $this->insertionProfessionnelles;
    }

    public function addInsertionProfessionnelle(InsertionProfessionnelle $insertionProfessionnelle): static
    {
        if (!$this->insertionProfessionnelles->contains($insertionProfessionnelle)) {
            $this->insertionProfessionnelles->add($insertionProfessionnelle);
            $insertionProfessionnelle->setLocalisation($this);
        }

        return $this;
    }

    public function removeInsertionProfessionnelle(InsertionProfessionnelle $insertionProfessionnelle): static
    {
        if ($this->insertionProfessionnelles->removeElement($insertionProfessionnelle)) {
            // set the owning side to null (unless already changed)
            if ($insertionProfessionnelle->getLocalisation() === $this) {
                $insertionProfessionnelle->setLocalisation(null);
            }
        }

        return $this;
    }
}
