<?php

namespace App\Entity;

use App\Repository\CarnetDeSanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarnetDeSanteRepository::class)]
class CarnetDeSante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numeroCarnet = null;

    /**
     * @var Collection<int, Vaccination>
     */
    #[ORM\ManyToMany(targetEntity: Vaccination::class, inversedBy: 'carnetDeSantes')]
    private Collection $idVaccination;

    /**
     * @var Collection<int, ListeMaladie>
     */
    #[ORM\ManyToMany(targetEntity: ListeMaladie::class, inversedBy: 'carnetDeSantes')]
    private Collection $idMaladie;

    #[ORM\OneToOne(mappedBy: 'idCarnet', cascade: ['persist', 'remove'])]
    private ?Animal $animal = null;

    public function __construct()
    {
        $this->idVaccination = new ArrayCollection();
        $this->idMaladie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCarnet(): ?int
    {
        return $this->numeroCarnet;
    }

    public function setNumeroCarnet(int $numeroCarnet): static
    {
        $this->numeroCarnet = $numeroCarnet;

        return $this;
    }

    /**
     * @return Collection<int, Vaccination>
     */
    public function getIdVaccination(): Collection
    {
        return $this->idVaccination;
    }

    public function addIdVaccination(Vaccination $idVaccination): static
    {
        if (!$this->idVaccination->contains($idVaccination)) {
            $this->idVaccination->add($idVaccination);
        }

        return $this;
    }

    public function removeIdVaccination(Vaccination $idVaccination): static
    {
        $this->idVaccination->removeElement($idVaccination);

        return $this;
    }

    /**
     * @return Collection<int, ListeMaladie>
     */
    public function getIdMaladie(): Collection
    {
        return $this->idMaladie;
    }

    public function addIdMaladie(ListeMaladie $idMaladie): static
    {
        if (!$this->idMaladie->contains($idMaladie)) {
            $this->idMaladie->add($idMaladie);
        }

        return $this;
    }

    public function removeIdMaladie(ListeMaladie $idMaladie): static
    {
        $this->idMaladie->removeElement($idMaladie);

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(Animal $animal): static
    {
        // set the owning side of the relation if necessary
        if ($animal->getIdCarnet() !== $this) {
            $animal->setIdCarnet($this);
        }

        $this->animal = $animal;

        return $this;
    }
}
