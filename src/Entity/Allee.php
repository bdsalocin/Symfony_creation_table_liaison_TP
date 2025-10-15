<?php

namespace App\Entity;

use App\Repository\AlleeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlleeRepository::class)]
class Allee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numeroAllee = null;

    /**
     * @var Collection<int, Employe>
     */
    #[ORM\OneToMany(targetEntity: Employe::class, mappedBy: 'allee')]
    private Collection $idEmploye;

    public function __construct()
    {
        $this->idEmploye = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroAllee(): ?int
    {
        return $this->numeroAllee;
    }

    public function setNumeroAllee(int $numeroAllee): static
    {
        $this->numeroAllee = $numeroAllee;

        return $this;
    }

    /**
     * @return Collection<int, Employe>
     */
    public function getIdEmploye(): Collection
    {
        return $this->idEmploye;
    }

    public function addIdEmploye(Employe $idEmploye): static
    {
        if (!$this->idEmploye->contains($idEmploye)) {
            $this->idEmploye->add($idEmploye);
            $idEmploye->setAllee($this);
        }

        return $this;
    }

    public function removeIdEmploye(Employe $idEmploye): static
    {
        if ($this->idEmploye->removeElement($idEmploye)) {
            // set the owning side to null (unless already changed)
            if ($idEmploye->getAllee() === $this) {
                $idEmploye->setAllee(null);
            }
        }

        return $this;
    }
}
