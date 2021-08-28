<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConsultationRepository::class)
 */
class Consultation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etat;

    /**
     * @ORM\OneToOne(targetEntity=Patient::class, inversedBy="consultation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="secretaireConsultations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $secretaire;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="medecinConsultations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $medecinTraitant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getSecretaire(): ?User
    {
        return $this->secretaire;
    }

    public function setSecretaire(?User $secretaire): self
    {
        $this->secretaire = $secretaire;

        return $this;
    }

    public function getMedecinTraitant(): ?User
    {
        return $this->medecinTraitant;
    }

    public function setMedecinTraitant(?User $medecinTraitant): self
    {
        $this->medecinTraitant = $medecinTraitant;

        return $this;
    }
}
