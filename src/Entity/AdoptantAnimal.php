<?php

namespace App\Entity;

use App\Repository\AdoptantAnimalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdoptantAnimalRepository::class)]
class AdoptantAnimal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateAdoption = null;

    #[ORM\ManyToOne(targetEntity: Adoptant::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adoptant $adoptant = null;

    #[ORM\ManyToOne(targetEntity: Animal::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAdoption(): ?\DateTime
    {
        return $this->dateAdoption;
    }

    public function setDateAdoption(?\DateTime $dateAdoption): static
    {
        $this->dateAdoption = $dateAdoption;

        return $this;
    }

    public function getAdoptant(): ?Adoptant
    {
        return $this->adoptant;
    }

    public function setAdoptant(?Adoptant $adoptant): static
    {
        $this->adoptant = $adoptant;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }
}
