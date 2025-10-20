<?php

namespace App\Entity;

use App\Repository\AdoptantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdoptantRepository::class)]
class Adoptant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomAdoptant = null;

    #[ORM\Column(length: 50)]
    private ?string $prenomAdoptant = null;

    #[ORM\Column(length: 100)]
    private ?string $adresseAdoptant = null;

    /**
     * @var Collection<int, Animal>
     */
    #[ORM\ManyToMany(targetEntity: Animal::class, mappedBy: 'idAdoptant')]
    private Collection $animals;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAdoptant(): ?string
    {
        return $this->nomAdoptant;
    }

    public function setNomAdoptant(string $nomAdoptant): static
    {
        $this->nomAdoptant = $nomAdoptant;

        return $this;
    }

    public function getPrenomAdoptant(): ?string
    {
        return $this->prenomAdoptant;
    }

    public function setPrenomAdoptant(string $prenomAdoptant): static
    {
        $this->prenomAdoptant = $prenomAdoptant;

        return $this;
    }

    public function getAdresseAdoptant(): ?string
    {
        return $this->adresseAdoptant;
    }

    public function setAdresseAdoptant(string $adresseAdoptant): static
    {
        $this->adresseAdoptant = $adresseAdoptant;

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
            $animal->addIdAdoptant($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->animals->removeElement($animal)) {
            $animal->removeIdAdoptant($this);
        }

        return $this;
    }
}
