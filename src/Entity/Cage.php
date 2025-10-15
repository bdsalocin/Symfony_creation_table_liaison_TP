<?php

namespace App\Entity;

use App\Repository\CageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CageRepository::class)]
class Cage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $fonctionnalite = null;

    /**
     * @var Collection<int, Animal>
     */
    #[ORM\OneToMany(targetEntity: Animal::class, mappedBy: 'idCage')]
    private Collection $animals;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
     * @var Collection<int, Allee>
     */
    #[ORM\OneToMany(targetEntity: Allee::class, mappedBy: 'cage')]
    private Collection $idAllee;

    /**
     * @var Collection<int, Employe>
     */
    #[ORM\OneToMany(targetEntity: Employe::class, mappedBy: 'cage')]
    private Collection $idEmploye;

    public function __construct()
    {
        $this->idAllee = new ArrayCollection();
        $this->idEmploye = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFonctionnalite(): ?string
    {
        return $this->fonctionnalite;
    }

    public function setFonctionnalite(string $fonctionnalite): static
    {
        $this->fonctionnalite = $fonctionnalite;

        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): static
    {
        if (!$this->animals->contains($animal)) {
            $this->animals->add($animal);
            $animal->setIdCage($this);
     * @return Collection<int, Allee>
     */
    public function getIdAllee(): Collection
    {
        return $this->idAllee;
    }

    public function addIdAllee(Allee $idAllee): static
    {
        if (!$this->idAllee->contains($idAllee)) {
            $this->idAllee->add($idAllee);
            $idAllee->setCage($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getIdCage() === $this) {
                $animal->setIdCage(null);
    public function removeIdAllee(Allee $idAllee): static
    {
        if ($this->idAllee->removeElement($idAllee)) {
            // set the owning side to null (unless already changed)
            if ($idAllee->getCage() === $this) {
                $idAllee->setCage(null);
            }
        }

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
            $idEmploye->setCage($this);
        }

        return $this;
    }

    public function removeIdEmploye(Employe $idEmploye): static
    {
        if ($this->idEmploye->removeElement($idEmploye)) {
            // set the owning side to null (unless already changed)
            if ($idEmploye->getCage() === $this) {
                $idEmploye->setCage(null);
            }
        }

        return $this;
    }
}
