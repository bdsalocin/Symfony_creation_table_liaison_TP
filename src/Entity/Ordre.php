<?php

namespace App\Entity;

use App\Repository\OrdreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdreRepository::class)]
class Ordre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $typeOrdre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeOrdre(): ?string
    {
        return $this->typeOrdre;
    }

    public function setTypeOrdre(string $typeOrdre): static
    {
        $this->typeOrdre = $typeOrdre;

        return $this;
    }
}
