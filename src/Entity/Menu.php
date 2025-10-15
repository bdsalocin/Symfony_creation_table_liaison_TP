<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomMenu = null;

    /**
     * @var Collection<int, Animal>
     */
    #[ORM\ManyToMany(targetEntity: Animal::class, mappedBy: 'idMenu')]
    private Collection $animals;

    /**
     * @var Collection<int, CompositionMenu>
     */
    #[ORM\ManyToMany(targetEntity: CompositionMenu::class)]
    private Collection $idCompoMenu;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
        $this->idCompoMenu = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMenu(): ?string
    {
        return $this->nomMenu;
    }

    public function setNomMenu(string $nomMenu): static
    {
        $this->nomMenu = $nomMenu;

        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): static
    {
        if (!$this->animals->contains($animal)) {
            $this->animals->add($animal);
            $animal->addIdMenu($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->animals->removeElement($animal)) {
            $animal->removeIdMenu($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, CompositionMenu>
     */
    public function getIdCompoMenu(): Collection
    {
        return $this->idCompoMenu;
    }

    public function addIdCompoMenu(CompositionMenu $idCompoMenu): static
    {
        if (!$this->idCompoMenu->contains($idCompoMenu)) {
            $this->idCompoMenu->add($idCompoMenu);
        }

        return $this;
    }

    public function removeIdCompoMenu(CompositionMenu $idCompoMenu): static
    {
        $this->idCompoMenu->removeElement($idCompoMenu);

        return $this;
    }
}
