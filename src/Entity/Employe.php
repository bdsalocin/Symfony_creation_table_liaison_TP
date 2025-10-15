<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
class Employe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomEmploye = null;

    #[ORM\Column(length: 50)]
    private ?string $prenomEmploye = null;

    #[ORM\Column(length: 50)]
    private ?string $ville = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 50)]
    private ?string $sexe = null;

    #[ORM\ManyToOne(inversedBy: 'idEmploye')]
    private ?Allee $allee = null;
    /**
     * @var Collection<int, Poste>
     */
    #[ORM\OneToMany(targetEntity: Poste::class, mappedBy: 'employe')]
    private Collection $idPoste;

    #[ORM\ManyToOne(inversedBy: 'idEmploye')]
    private ?Cage $cage = null;

    public function __construct()
    {
        $this->idPoste = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEmploye(): ?string
    {
        return $this->nomEmploye;
    }

    public function setNomEmploye(string $nomEmploye): static
    {
        $this->nomEmploye = $nomEmploye;

        return $this;
    }

    public function getPrenomEmploye(): ?string
    {
        return $this->prenomEmploye;
    }

    public function setPrenomEmploye(string $prenomEmploye): static
    {
        $this->prenomEmploye = $prenomEmploye;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getAllee(): ?Allee
    {
        return $this->allee;
    }

    public function setAllee(?Allee $allee): static
    {
        $this->allee = $allee;

        return $this;
    }

    /**
     * @return Collection<int, Poste>
     */
    public function getIdPoste(): Collection
    {
        return $this->idPoste;
    }

    public function addIdPoste(Poste $idPoste): static
    {
        if (!$this->idPoste->contains($idPoste)) {
            $this->idPoste->add($idPoste);
            $idPoste->setEmploye($this);
        }

        return $this;
    }

    public function removeIdPoste(Poste $idPoste): static
    {
        if ($this->idPoste->removeElement($idPoste)) {
            // set the owning side to null (unless already changed)
            if ($idPoste->getEmploye() === $this) {
                $idPoste->setEmploye(null);
            }
        }

        return $this;
    }

    public function getCage(): ?Cage
    {
        return $this->cage;
    }

    public function setCage(?Cage $cage): static
    {
        $this->cage = $cage;

        return $this;
    }
}
