<?php

namespace App\Entity;

use App\Repository\ListeMaladieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeMaladieRepository::class)]
class ListeMaladie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomMaladie = null;

    /**
     * @var Collection<int, CarnetDeSante>
     */
    #[ORM\ManyToMany(targetEntity: CarnetDeSante::class, mappedBy: 'idMaladie')]
    private Collection $carnetDeSantes;

    /**
     * @var Collection<int, Animal>
     */
    #[ORM\ManyToMany(targetEntity: Animal::class, mappedBy: 'idListeMaladie')]
    private Collection $animals;

    /**
     * @var Collection<int, CarnetDeSante>
     */
    #[ORM\ManyToMany(targetEntity: CarnetDeSante::class, inversedBy: 'listemaladies')]
    private Collection $idCarnetDeSante;

    public function __construct()
    {
        $this->carnetDeSantes = new ArrayCollection();
        $this->animals = new ArrayCollection();
        $this->idCarnetDeSante = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMaladie(): ?string
    {
        return $this->nomMaladie;
    }

    public function setNomMaladie(string $nomMaladie): static
    {
        $this->nomMaladie = $nomMaladie;

        return $this;
    }

    /**
     * @return Collection<int, CarnetDeSante>
     */
    public function getCarnetDeSantes(): Collection
    {
        return $this->carnetDeSantes;
    }

    public function addCarnetDeSante(CarnetDeSante $carnetDeSante): static
    {
        if (!$this->carnetDeSantes->contains($carnetDeSante)) {
            $this->carnetDeSantes->add($carnetDeSante);
            $carnetDeSante->addIdMaladie($this);
        }

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
            $animal->addIdListeMaladie($this);
        }

        return $this;
    }

    public function removeCarnetDeSante(CarnetDeSante $carnetDeSante): static
    {
        if ($this->carnetDeSantes->removeElement($carnetDeSante)) {
            $carnetDeSante->removeIdMaladie($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->animals->removeElement($animal)) {
            $animal->removeIdListeMaladie($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, CarnetDeSante>
     */
    public function getIdCarnetDeSante(): Collection
    {
        return $this->idCarnetDeSante;
    }

    public function addIdCarnetDeSante(CarnetDeSante $idCarnetDeSante): static
    {
        if (!$this->idCarnetDeSante->contains($idCarnetDeSante)) {
            $this->idCarnetDeSante->add($idCarnetDeSante);
        }

        return $this;
    }

    public function removeIdCarnetDeSante(CarnetDeSante $idCarnetDeSante): static
    {
        $this->idCarnetDeSante->removeElement($idCarnetDeSante);

        return $this;
    }
}
