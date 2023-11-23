<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 13, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $avatar;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 8, nullable: true)]
    private ?string $numEtud = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptionEntreprise = null;

    #[ORM\Column(length: 14, nullable: true)]
    private ?string $numSiret = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $tpUser = null;

    #[ORM\OneToMany(mappedBy: 'Company', targetEntity: InsertionProfessionnelle::class)]
    private Collection $insertions_professionnelles;

    private $rawAvatar;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Formation $formation = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    private ?Ecole $ecole = null;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Localisation::class, orphanRemoval: true)]
    private Collection $localisations;

    public function __construct()
    {
        $this->insertions_professionnelles = new ArrayCollection();
        $this->localisations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
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

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getNumEtud(): ?string
    {
        return $this->numEtud;
    }

    public function setNumEtud(?string $numEtud): static
    {
        $this->numEtud = $numEtud;

        return $this;
    }

    public function getDescriptionEntreprise(): ?string
    {
        return $this->descriptionEntreprise;
    }

    public function setDescriptionEntreprise(?string $descriptionEntreprise): static
    {
        $this->descriptionEntreprise = $descriptionEntreprise;

        return $this;
    }

    public function getNumSiret(): ?string
    {
        return $this->numSiret;
    }

    public function setNumSiret(?string $numSiret): static
    {
        $this->numSiret = $numSiret;

        return $this;
    }

    public function getTpUser(): ?int
    {
        return $this->tpUser;
    }

    public function setTpUser(int $tpUser): static
    {
        $this->tpUser = $tpUser;

        return $this;
    }

    /**
     * @return Collection<int, InsertionProfessionnelle>
     */
    public function getInsertionsProfessionnelles(): Collection
    {
        return $this->insertions_professionnelles;
    }

    public function addInsertionsProfessionnelle(InsertionProfessionnelle $insertionsProfessionnelle): static
    {
        if (!$this->insertions_professionnelles->contains($insertionsProfessionnelle)) {
            $this->insertions_professionnelles->add($insertionsProfessionnelle);
            $insertionsProfessionnelle->setCompany($this);
        }
    }

    public function displayAvatar()
    {
        if (null === $this->rawAvatar) {
            if (null === $this->getAvatar()) {
                return null;
            }
            $this->rawAvatar = 'data:image/jpeg;base64,'.base64_encode(stream_get_contents($this->getAvatar()));
        }

        return $this->rawAvatar;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): static
    {
        $this->formation = $formation;

        return $this;
    }

    public function getEcole(): ?Ecole
    {
        return $this->ecole;
    }

    public function setEcole(?Ecole $ecole): static
    {
        $this->ecole = $ecole;

        return $this;
    }

    /**
     * @return Collection<int, Localisation>
     */
    public function getLocalisations(): Collection
    {
        return $this->localisations;
    }

    public function addLocalisation(Localisation $localisation): static
    {
        if (!$this->localisations->contains($localisation)) {
            $this->localisations->add($localisation);
            $localisation->setEntreprise($this);
        }

        return $this;
    }

    public function removeInsertionsProfessionnelle(InsertionProfessionnelle $insertionsProfessionnelle): static
    {
        if ($this->insertions_professionnelles->removeElement($insertionsProfessionnelle)) {
            // set the owning side to null (unless already changed)
            if ($insertionsProfessionnelle->getCompany() === $this) {
                $insertionsProfessionnelle->setCompany(null);
            }
        }
    }

    public function removeLocalisation(Localisation $localisation): static
    {
        if ($this->localisations->removeElement($localisation)) {
            // set the owning side to null (unless already changed)
            if ($localisation->getEntreprise() === $this) {
                $localisation->setEntreprise(null);
            }
        }

        return $this;
    }
}
