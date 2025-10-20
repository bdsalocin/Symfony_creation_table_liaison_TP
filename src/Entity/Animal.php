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
     * @var Collection<int, Vaccination>
     */
    #[ORM\ManyToMany(targetEntity: Vaccination::class, mappedBy: 'idAnimal')]
    private Collection $vaccinations;

    /**
     * @var Collection<int, Menu>
     */
    #[ORM\ManyToMany(targetEntity: Menu::class, inversedBy: 'animals')]
    private Collection $idMenu;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cage $idCage = null;

    #[ORM\OneToOne(inversedBy: 'animal', cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?CarnetDeSante $idCarnet = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Espece $idEspece = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Famille $idFamille = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Classe $idClasse = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ordre $idOrdre = null;

    /**
     * @var Collection<int, ListeMaladie>
     */
    #[ORM\ManyToMany(targetEntity: ListeMaladie::class, inversedBy: 'animals')]
    private Collection $idListeMaladie;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Comportement $idComportement = null;


    /**
     * @var Collection<int, Adoptant>
     */
    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Adoptant $idAdoptant = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $adoptable = null;

    public function __construct()
    {
        $this->vaccinations = new ArrayCollection();
        $this->idMenu = new ArrayCollection();
        $this->idListeMaladie = new ArrayCollection();
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
            $vaccination->addIdAnimal($this);
        }

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

    public function removeVaccination(Vaccination $vaccination): static
    {
        if ($this->vaccinations->removeElement($vaccination)) {
            $vaccination->removeIdAnimal($this);
        }

        return $this;
    }

    public function removeIdListeMaladie(ListeMaladie $idListeMaladie): static
    {
        $this->idListeMaladie->removeElement($idListeMaladie);

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getIdMenu(): Collection
    {
        return $this->idMenu;
    }

    public function addIdMenu(Menu $idMenu): static
    {
        if (!$this->idMenu->contains($idMenu)) {
            $this->idMenu->add($idMenu);
        }

        return $this;
    }

    public function getIdComportement(): ?Comportement
    {
        return $this->idComportement;
    }

    public function setIdComportement(?Comportement $idComportement): static
    {
        $this->idComportement = $idComportement;
        return $this;
    }

    public function removeIdMenu(Menu $idMenu): static
    {
        $this->idMenu->removeElement($idMenu);

        return $this;
    }

    public function getIdCage(): ?Cage
    {
        return $this->idCage;
    }

    public function setIdCage(?Cage $idCage): static
    {
        $this->idCage = $idCage;

        return $this;
    }

    public function getIdCarnet(): ?CarnetDeSante
    {
        return $this->idCarnet;
    }

    public function setIdCarnet(CarnetDeSante $idCarnet): static
    {
        $this->idCarnet = $idCarnet;

        return $this;
    }


    public function getIdEspece(): ?Espece
    {
        return $this->idEspece;
    }

    public function setIdEspece(?Espece $idEspece): static
    {
        $this->idEspece = $idEspece;

        return $this;
    }

    public function getIdFamille(): ?Famille
    {
        return $this->idFamille;
    }

    public function setIdFamille(?Famille $idFamille): static
    {
        $this->idFamille = $idFamille;

        return $this;
    }

    public function getIdClasse(): ?Classe
    {
        return $this->idClasse;
    }

    public function setIdClasse(?Classe $idClasse): static
    {
        $this->idClasse = $idClasse;

        return $this;
    }

    /**
     * @return Collection<int, Adoptant>
     */

    public function getIdAdoptant(): ?Adoptant
    {
        return $this->idAdoptant;
    }

    public function setIdAdoptant(?Adoptant $idAdoptant): static
    {
        $this->idAdoptant = $idAdoptant;
        return $this;
    }

    public function addIdAdoptant(Adoptant $idAdoptant): static
    {
        if (!$this->idAdoptant->contains($idAdoptant)) {
            $this->idAdoptant->add($idAdoptant);
        }

        return $this;
    }

    public function getIdOrdre(): ?Ordre
    {
        return $this->idOrdre;
    }

    public function setIdOrdre(?Ordre $idOrdre): static
    {
        $this->idOrdre = $idOrdre;

        return $this;
    }

    public function removeIdAdoptant(Adoptant $idAdoptant): static
    {
        $this->idAdoptant->removeElement($idAdoptant);

        return $this;
    }
    
    public function isAdoptable(): ?bool
    {
        return $this->adoptable;
    }

    public function setAdoptable(?bool $adoptable): static
    {
        $this->adoptable = $adoptable;
        return $this;
    }
}
