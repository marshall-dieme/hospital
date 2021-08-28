<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $assurance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeAssurance;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomParentAPrevenir;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telParentAPrevenir;

    /**
     * @ORM\OneToOne(targetEntity=Consultation::class, mappedBy="patient", cascade={"persist", "remove"})
     */
    private $consultation;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

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

    public function getAssurance(): ?string
    {
        return $this->assurance;
    }

    public function setAssurance(string $assurance): self
    {
        $this->assurance = $assurance;

        return $this;
    }

    public function getCodeAssurance(): ?string
    {
        return $this->codeAssurance;
    }

    public function setCodeAssurance(string $codeAssurance): self
    {
        $this->codeAssurance = $codeAssurance;

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

    public function getNomParentAPrevenir(): ?string
    {
        return $this->nomParentAPrevenir;
    }

    public function setNomParentAPrevenir(string $nomParentAPrevenir): self
    {
        $this->nomParentAPrevenir = $nomParentAPrevenir;

        return $this;
    }

    public function getTelParentAPrevenir(): ?string
    {
        return $this->telParentAPrevenir;
    }

    public function setTelParentAPrevenir(string $telParentAPrevenir): self
    {
        $this->telParentAPrevenir = $telParentAPrevenir;

        return $this;
    }

    public function getConsultation(): ?Consultation
    {
        return $this->consultation;
    }

    public function setConsultation(Consultation $consultation): self
    {
        // set the owning side of the relation if necessary
        if ($consultation->getPatient() !== $this) {
            $consultation->setPatient($this);
        }

        $this->consultation = $consultation;

        return $this;
    }
}
