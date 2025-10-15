<?php

namespace App\Entity;

use App\Repository\VaccinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VaccinationRepository::class)]
class Vaccination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateVaccination = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateProchaineVaccination = null;

    #[ORM\Column]
    private ?int $numeroVaccination = null;

    /**
     * @var Collection<int, CarnetDeSante>
     */
    #[ORM\ManyToMany(targetEntity: CarnetDeSante::class, mappedBy: 'idVaccination')]
    private Collection $carnetDeSantes;

    /**
     * @var Collection<int, ListeVaccin>
     */
    #[ORM\ManyToMany(targetEntity: ListeVaccin::class, inversedBy: 'vaccinations')]
    private Collection $idListeVaccin;

    /**
     * @var Collection<int, Animal>
     */
    #[ORM\ManyToMany(targetEntity: Animal::class, inversedBy: 'vaccinations')]
    private Collection $idAnimal;

    public function __construct()
    {
        $this->carnetDeSantes = new ArrayCollection();
        $this->idListeVaccin = new ArrayCollection();
        $this->idAnimal = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateVaccination(): ?\DateTime
    {
        return $this->dateVaccination;
    }

    public function setDateVaccination(\DateTime $dateVaccination): static
    {
        $this->dateVaccination = $dateVaccination;

        return $this;
    }

    public function getDateProchaineVaccination(): ?\DateTime
    {
        return $this->dateProchaineVaccination;
    }

    public function setDateProchaineVaccination(\DateTime $dateProchaineVaccination): static
    {
        $this->dateProchaineVaccination = $dateProchaineVaccination;

        return $this;
    }

    public function getNumeroVaccination(): ?int
    {
        return $this->numeroVaccination;
    }

    public function setNumeroVaccination(int $numeroVaccination): static
    {
        $this->numeroVaccination = $numeroVaccination;

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
            $carnetDeSante->addIdVaccination($this);
        }

        return $this;
    }

    public function removeCarnetDeSante(CarnetDeSante $carnetDeSante): static
    {
        if ($this->carnetDeSantes->removeElement($carnetDeSante)) {
            $carnetDeSante->removeIdVaccination($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ListeVaccin>
     */
    public function getIdListeVaccin(): Collection
    {
        return $this->idListeVaccin;
    }

    public function addIdListeVaccin(ListeVaccin $idListeVaccin): static
    {
        if (!$this->idListeVaccin->contains($idListeVaccin)) {
            $this->idListeVaccin->add($idListeVaccin);
        }

        return $this;
    }

    public function removeIdListeVaccin(ListeVaccin $idListeVaccin): static
    {
        $this->idListeVaccin->removeElement($idListeVaccin);

        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getIdAnimal(): Collection
    {
        return $this->idAnimal;
    }

    public function addIdAnimal(Animal $idAnimal): static
    {
        if (!$this->idAnimal->contains($idAnimal)) {
            $this->idAnimal->add($idAnimal);
        }

        return $this;
    }

    public function removeIdAnimal(Animal $idAnimal): static
    {
        $this->idAnimal->removeElement($idAnimal);

        return $this;
    }
}
