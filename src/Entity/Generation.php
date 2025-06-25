<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GenerationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: ['name', 'model'], message: 'This generation already exists for this model.')]
#[ORM\Entity(repositoryClass: GenerationRepository::class)]
#[ApiResource]
class Generation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'generations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Model $model = null;

    /**
     * @var Collection<int, FuelType>
     */
    #[ORM\OneToMany(targetEntity: FuelType::class, mappedBy: 'generation', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $fuelTypes;

    public function __construct()
    {
        $this->fuelTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getBrandName(): ?string
    {
        return $this->model?->getBrand()?->getName();
    }

    /**
     * @return Collection<int, FuelType>
     */
    public function getFuelTypes(): Collection
    {
        return $this->fuelTypes;
    }

    public function addFuelType(FuelType $fuelType): static
    {
        if (!$this->fuelTypes->contains($fuelType)) {
            $this->fuelTypes->add($fuelType);
            $fuelType->setGeneration($this);
        }

        return $this;
    }

    public function removeFuelType(FuelType $fuelType): static
    {
        if ($this->fuelTypes->removeElement($fuelType)) {
            // set the owning side to null (unless already changed)
            if ($fuelType->getGeneration() === $this) {
                $fuelType->setGeneration(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        $modelName = $this->getModel()?->getName() ?? '';
        $brandName = $this->getModel()?->getBrand()?->getName() ?? '';
        return sprintf('%s - %s - %s', $brandName, $modelName, $this->getName());
    }
}
