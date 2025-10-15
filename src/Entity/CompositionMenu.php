<?php

namespace App\Entity;

use App\Repository\CompositionMenuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompositionMenuRepository::class)]
class CompositionMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantit�e = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantit�e(): ?int
    {
        return $this->quantit�e;
    }

    public function setQuantit�e(int $quantit�e): static
    {
        $this->quantit�e = $quantit�e;

        return $this;
    }
}
