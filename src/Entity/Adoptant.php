<?php

namespace App\Entity;

use App\Repository\AdoptantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdoptantRepository::class)]
class Adoptant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomAdoptant = null;

    #[ORM\Column(length: 50)]
    private ?string $prenomAdoptant = null;

    #[ORM\Column(length: 100)]
    private ?string $adresseAdoptant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAdoptant(): ?string
    {
        return $this->nomAdoptant;
    }

    public function setNomAdoptant(string $nomAdoptant): static
    {
        $this->nomAdoptant = $nomAdoptant;

        return $this;
    }

    public function getPrenomAdoptant(): ?string
    {
        return $this->prenomAdoptant;
    }

    public function setPrenomAdoptant(string $prenomAdoptant): static
    {
        $this->prenomAdoptant = $prenomAdoptant;

        return $this;
    }

    public function getAdresseAdoptant(): ?string
    {
        return $this->adresseAdoptant;
    }

    public function setAdresseAdoptant(string $adresseAdoptant): static
    {
        $this->adresseAdoptant = $adresseAdoptant;

        return $this;
    }
}
