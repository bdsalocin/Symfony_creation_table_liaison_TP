<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomAnimal = null;

    #[ORM\Column(length: 50)]
    private ?string $originePays = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateNaissance = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateArrivee = null;

    #[ORM\Column(length: 50)]
    private ?string $nomPere = null;

    #[ORM\Column(length: 50)]
    private ?string $nomMere = null;

    #[ORM\Column(length: 50)]
    private ?string $raceAnimal = null;

    #[ORM\Column(length: 8)]
    private ?string $sexeAnimal = null;

    /**
     * @var Collection<int, ListeMaladie>
     */
    #[ORM\ManyToMany(targetEntity: ListeMaladie::class, inversedBy: 'animals')]
    private Collection $idListeMaladie;

    /**
     * @var Collection<int, Comportement>
     */
    #[ORM\ManyToMany(targetEntity: Comportement::class, inversedBy: 'animals')]
    private Collection $idComportement;

    /**
     * @var Collection<int, Adoptant>
     */
    #[ORM\ManyToMany(targetEntity: Adoptant::class, inversedBy: 'animals')]
    private Collection $idAdoptant;

    public function __construct()
    {
        $this->idListeMaladie = new ArrayCollection();
        $this->idComportement = new ArrayCollection();
        $this->idAdoptant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAnimal(): ?string
    {
        return $this->nomAnimal;
    }

    public function setNomAnimal(string $nomAnimal): static
    {
        $this->nomAnimal = $nomAnimal;

        return $this;
    }

    public function getOriginePays(): ?string
    {
        return $this->originePays;
    }

    public function setOriginePays(string $originePays): static
    {
        $this->originePays = $originePays;

        return $this;
    }

    public function getDateNaissance(): ?\DateTime
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTime $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getDateArrivee(): ?\DateTime
    {
        return $this->dateArrivee;
    }

    public function setDateArrivee(\DateTime $dateArrivee): static
    {
        $this->dateArrivee = $dateArrivee;

        return $this;
    }

    public function getNomPere(): ?string
    {
        return $this->nomPere;
    }

    public function setNomPere(string $nomPere): static
    {
        $this->nomPere = $nomPere;

        return $this;
    }

    public function getNomMere(): ?string
    {
        return $this->nomMere;
    }

    public function setNomMere(string $nomMere): static
    {
        $this->nomMere = $nomMere;

        return $this;
    }

    public function getRaceAnimal(): ?string
    {
        return $this->raceAnimal;
    }

    public function setRaceAnimal(string $raceAnimal): static
    {
        $this->raceAnimal = $raceAnimal;

        return $this;
    }

    public function getSexeAnimal(): ?string
    {
        return $this->sexeAnimal;
    }

    public function setSexeAnimal(string $sexeAnimal): static
    {
        $this->sexeAnimal = $sexeAnimal;

        return $this;
    }

    /**
     * @return Collection<int, ListeMaladie>
     */
    public function getIdListeMaladie(): Collection
    {
        return $this->idListeMaladie;
    }

    public function addIdListeMaladie(ListeMaladie $idListeMaladie): static
    {
        if (!$this->idListeMaladie->contains($idListeMaladie)) {
            $this->idListeMaladie->add($idListeMaladie);
        }

        return $this;
    }

    public function removeIdListeMaladie(ListeMaladie $idListeMaladie): static
    {
        $this->idListeMaladie->removeElement($idListeMaladie);

        return $this;
    }

    /**
     * @return Collection<int, Comportement>
     */
    public function getIdComportement(): Collection
    {
        return $this->idComportement;
    }

    public function addIdComportement(Comportement $idComportement): static
    {
        if (!$this->idComportement->contains($idComportement)) {
            $this->idComportement->add($idComportement);
        }

        return $this;
    }

    public function removeIdComportement(Comportement $idComportement): static
    {
        $this->idComportement->removeElement($idComportement);

        return $this;
    }

    /**
     * @return Collection<int, Adoptant>
     */
    public function getIdAdoptant(): Collection
    {
        return $this->idAdoptant;
    }

    public function addIdAdoptant(Adoptant $idAdoptant): static
    {
        if (!$this->idAdoptant->contains($idAdoptant)) {
            $this->idAdoptant->add($idAdoptant);
        }

        return $this;
    }

    public function removeIdAdoptant(Adoptant $idAdoptant): static
    {
        $this->idAdoptant->removeElement($idAdoptant);

        return $this;
    }
}
