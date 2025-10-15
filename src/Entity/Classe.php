<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $typeClasse = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeClasse(): ?string
    {
        return $this->typeClasse;
    }

    public function setTypeClasse(string $typeClasse): static
    {
        $this->typeClasse = $typeClasse;

        return $this;
    }
}
