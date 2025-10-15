<?php

namespace App\Entity;

use App\Repository\AlleeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlleeRepository::class)]
class Allee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numeroAllee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroAllee(): ?int
    {
        return $this->numeroAllee;
    }

    public function setNumeroAllee(int $numeroAllee): static
    {
        $this->numeroAllee = $numeroAllee;

        return $this;
    }
}
