<?php

namespace App\Entity;

use App\Repository\CarnetDeSanteRepository;
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
}