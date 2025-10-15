<?php

namespace App\Entity;

use App\Repository\EspeceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspeceRepository::class)]
class Espece
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomEspece = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEspece(): ?string
    {
        return $this->nomEspece;
    }

    public function setNomEspece(string $nomEspece): static
    {
        $this->nomEspece = $nomEspece;

        return $this;
    }
}
