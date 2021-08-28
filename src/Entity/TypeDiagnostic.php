<?php

namespace App\Entity;

use App\Repository\TypeDiagnosticRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeDiagnosticRepository::class)
 */
class TypeDiagnostic
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Diagnostic::class, mappedBy="typeDiagnostic")
     */
    private $diagnostics;

    public function __construct()
    {
        $this->diagnostics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Diagnostic[]
     */
    public function getDiagnostics(): Collection
    {
        return $this->diagnostics;
    }

    public function addDiagnostic(Diagnostic $diagnostic): self
    {
        if (!$this->diagnostics->contains($diagnostic)) {
            $this->diagnostics[] = $diagnostic;
            $diagnostic->setTypeDiagnostic($this);
        }

        return $this;
    }

    public function removeDiagnostic(Diagnostic $diagnostic): self
    {
        if ($this->diagnostics->removeElement($diagnostic)) {
            // set the owning side to null (unless already changed)
            if ($diagnostic->getTypeDiagnostic() === $this) {
                $diagnostic->setTypeDiagnostic(null);
            }
        }

        return $this;
    }
}
