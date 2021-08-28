<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telephone;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $sexe;

    /**
     * @ORM\Column(type="text")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $situationFamiliale;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     */
    private $profil;

    /**
     * @ORM\OneToMany(targetEntity=Consultation::class, mappedBy="secretaire")
     */
    private $secretaireConsultations;

    /**
     * @ORM\OneToMany(targetEntity=Consultation::class, mappedBy="medecinTraitant")
     */
    private $medecinConsultations;

    /**
     * @ORM\ManyToOne(targetEntity=Specialite::class, inversedBy="medecin")
     */
    private $specialiteMedecin;

    public function __construct()
    {
        $this->secretaireConsultations = new ArrayCollection();
        $this->medecinConsultations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
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

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getSituationFamiliale(): ?string
    {
        return $this->situationFamiliale;
    }

    public function setSituationFamiliale(string $situationFamiliale): self
    {
        $this->situationFamiliale = $situationFamiliale;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * @return Collection|Consultation[]
     */
    public function getSecretaireConsultations(): Collection
    {
        return $this->secretaireConsultations;
    }

    public function addSecretaireConsultation(Consultation $secretaireConsultation): self
    {
        if (!$this->secretaireConsultations->contains($secretaireConsultation)) {
            $this->secretaireConsultations[] = $secretaireConsultation;
            $secretaireConsultation->setSecretaire($this);
        }

        return $this;
    }

    public function removeSecretaireConsultation(Consultation $secretaireConsultation): self
    {
        if ($this->secretaireConsultations->removeElement($secretaireConsultation)) {
            // set the owning side to null (unless already changed)
            if ($secretaireConsultation->getSecretaire() === $this) {
                $secretaireConsultation->setSecretaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Consultation[]
     */
    public function getMedecinConsultations(): Collection
    {
        return $this->medecinConsultations;
    }

    public function addMedecinConsultation(Consultation $medecinConsultation): self
    {
        if (!$this->medecinConsultations->contains($medecinConsultation)) {
            $this->medecinConsultations[] = $medecinConsultation;
            $medecinConsultation->setMedecinTraitant($this);
        }

        return $this;
    }

    public function removeMedecinConsultation(Consultation $medecinConsultation): self
    {
        if ($this->medecinConsultations->removeElement($medecinConsultation)) {
            // set the owning side to null (unless already changed)
            if ($medecinConsultation->getMedecinTraitant() === $this) {
                $medecinConsultation->setMedecinTraitant(null);
            }
        }

        return $this;
    }

    public function getSpecialiteMedecin(): ?Specialite
    {
        return $this->specialiteMedecin;
    }

    public function setSpecialiteMedecin(?Specialite $specialiteMedecin): self
    {
        $this->specialiteMedecin = $specialiteMedecin;

        return $this;
    }
}
