<?php

namespace App\Entity;

use App\Repository\PosteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PosteRepository::class)]
class Poste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?string $nomPoste = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPoste(): ?string
    {
        return $this->nomPoste;
    }

    public function setNomPoste(string $nomPoste): static
    {
        $this->nomPoste = $nomPoste;

        return $this;
    }
}
