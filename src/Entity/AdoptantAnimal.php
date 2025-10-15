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
}
