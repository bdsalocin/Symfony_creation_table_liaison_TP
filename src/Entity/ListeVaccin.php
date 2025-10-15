<?php

namespace App\Entity;

use App\Repository\ListeVaccinRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeVaccinRepository::class)]
class ListeVaccin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomVaccin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVaccin(): ?string
    {
        return $this->nomVaccin;
    }

    public function setNomVaccin(string $nomVaccin): static
    {
        $this->nomVaccin = $nomVaccin;

        return $this;
    }
}
