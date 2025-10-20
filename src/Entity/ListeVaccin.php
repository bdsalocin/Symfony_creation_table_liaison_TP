<?php

namespace App\Entity;

use App\Repository\ListeVaccinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Vaccination>
     */
    #[ORM\ManyToMany(targetEntity: Vaccination::class, mappedBy: 'idListeVaccin')]
    private Collection $vaccinations;

    public function __construct()
    {
        $this->vaccinations = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Vaccination>
     */
    public function getVaccinations(): Collection
    {
        return $this->vaccinations;
    }

    public function addVaccination(Vaccination $vaccination): static
    {
        if (!$this->vaccinations->contains($vaccination)) {
            $this->vaccinations->add($vaccination);
            $vaccination->addIdListeVaccin($this);
        }

        return $this;
    }

    public function removeVaccination(Vaccination $vaccination): static
    {
        if ($this->vaccinations->removeElement($vaccination)) {
            $vaccination->removeIdListeVaccin($this);
        }

        return $this;
    }
}
