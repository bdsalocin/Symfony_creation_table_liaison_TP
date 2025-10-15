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

    #[ORM\ManyToOne(inversedBy: 'idAllee')]
    private ?Cage $cage = null;

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

    public function getCage(): ?Cage
    {
        return $this->cage;
    }

    public function setCage(?Cage $cage): static
    {
        $this->cage = $cage;

        return $this;
    }
}
