<?php

namespace App\Entity;

use App\Repository\CompositionMenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompositionMenuRepository::class)]
class CompositionMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    /**
     * @var Collection<int, Aliment>
     */
    #[ORM\ManyToMany(targetEntity: Aliment::class)]
    private Collection $idAliment;

    public function __construct()
    {
        $this->idAliment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * @return Collection<int, Aliment>
     */
    public function getIdAliment(): Collection
    {
        return $this->idAliment;
    }

    public function addIdAliment(Aliment $idAliment): static
    {
        if (!$this->idAliment->contains($idAliment)) {
            $this->idAliment->add($idAliment);
        }

        return $this;
    }

    public function removeIdAliment(Aliment $idAliment): static
    {
        $this->idAliment->removeElement($idAliment);

        return $this;
    }
}
