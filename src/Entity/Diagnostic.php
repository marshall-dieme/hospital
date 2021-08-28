<?php

namespace App\Entity;

use App\Repository\DiagnosticRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiagnosticRepository::class)
 */
class Diagnostic
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
    private $dateAdmission;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $motifAdmission;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateSortie;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDeces;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $motifSortie;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $motifDeces;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $prescriptions = [];

    /**
     * @ORM\ManyToOne(targetEntity=TypeDiagnostic::class, inversedBy="diagnostics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeDiagnostic;

    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class, inversedBy="hospitalisations")
     */
    private $chambre;

    /**
     * @ORM\OneToOne(targetEntity=Facture::class, mappedBy="diagnostic", cascade={"persist", "remove"})
     */
    private $facture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAdmission(): ?\DateTimeInterface
    {
        return $this->dateAdmission;
    }

    public function setDateAdmission(\DateTimeInterface $dateAdmission): self
    {
        $this->dateAdmission = $dateAdmission;

        return $this;
    }

    public function getMotifAdmission(): ?string
    {
        return $this->motifAdmission;
    }

    public function setMotifAdmission(string $motifAdmission): self
    {
        $this->motifAdmission = $motifAdmission;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(\DateTimeInterface $dateSortie): self
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getDateDeces(): ?\DateTimeInterface
    {
        return $this->dateDeces;
    }

    public function setDateDeces(?\DateTimeInterface $dateDeces): self
    {
        $this->dateDeces = $dateDeces;

        return $this;
    }

    public function getMotifSortie(): ?string
    {
        return $this->motifSortie;
    }

    public function setMotifSortie(string $motifSortie): self
    {
        $this->motifSortie = $motifSortie;

        return $this;
    }

    public function getMotifDeces(): ?string
    {
        return $this->motifDeces;
    }

    public function setMotifDeces(?string $motifDeces): self
    {
        $this->motifDeces = $motifDeces;

        return $this;
    }

    public function getPrescriptions(): ?array
    {
        return $this->prescriptions;
    }

    public function setPrescriptions(?array $prescriptions): self
    {
        $this->prescriptions = $prescriptions;

        return $this;
    }

    public function getTypeDiagnostic(): ?TypeDiagnostic
    {
        return $this->typeDiagnostic;
    }

    public function setTypeDiagnostic(?TypeDiagnostic $typeDiagnostic): self
    {
        $this->typeDiagnostic = $typeDiagnostic;

        return $this;
    }

    public function getChambre(): ?Chambre
    {
        return $this->chambre;
    }

    public function setChambre(?Chambre $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(Facture $facture): self
    {
        // set the owning side of the relation if necessary
        if ($facture->getDiagnostic() !== $this) {
            $facture->setDiagnostic($this);
        }

        $this->facture = $facture;

        return $this;
    }
}
