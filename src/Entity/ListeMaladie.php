<?php

namespace App\Entity;

use App\Repository\ListeMaladieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeMaladieRepository::class)]
class ListeMaladie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomMaladie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMaladie(): ?string
    {
        return $this->nomMaladie;
    }

    public function setNomMaladie(string $nomMaladie): static
    {
        $this->nomMaladie = $nomMaladie;

        return $this;
    }
}
