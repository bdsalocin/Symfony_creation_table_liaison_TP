<?php

namespace App\Entity;

use App\Repository\VaccinationRepository;
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
}
