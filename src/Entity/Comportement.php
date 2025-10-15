<?php

namespace App\Entity;

use App\Repository\ComportementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComportementRepository::class)]
class Comportement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $typeComportement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeComportement(): ?string
    {
        return $this->typeComportement;
    }

    public function setTypeComportement(string $typeComportement): static
    {
        $this->typeComportement = $typeComportement;

        return $this;
    }
}
