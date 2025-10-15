<?php

namespace App\Entity;

use App\Repository\CageRepository;
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
}
