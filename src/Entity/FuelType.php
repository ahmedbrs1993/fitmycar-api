<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FuelTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: ['generation', 'fuel'], message: 'This fuel is already assigned to this generation.')]
#[ORM\Entity(repositoryClass: FuelTypeRepository::class)]
#[ApiResource]
class FuelType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fuel $fuel = null;

    #[ORM\ManyToOne(inversedBy: 'fuelTypes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Generation $generation = null;

    /**
     * @var Collection<int, ProductCompatibility>
     */
    #[ORM\OneToMany(targetEntity: ProductCompatibility::class, mappedBy: 'fuelType')]
    private Collection $productCompatibilities;

    public function __construct()
    {
        $this->productCompatibilities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFuel(): ?Fuel
    {
        return $this->fuel;
    }

    public function setFuel(?Fuel $fuel): static
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getGeneration(): ?Generation
    {
        return $this->generation;
    }

    public function setGeneration(?Generation $generation): static
    {
        $this->generation = $generation;

        return $this;
    }

    public function getModelName(): ?string
    {
        return $this->getGeneration()?->getModel()?->getName();
    }

    public function getBrandName(): ?string
    {
        return $this->getGeneration()?->getModel()?->getBrand()?->getName();
    }

    /**
     * @return Collection<int, ProductCompatibility>
     */
    public function getProductCompatibilities(): Collection
    {
        return $this->productCompatibilities;
    }

    public function addProductCompatibility(ProductCompatibility $productCompatibility): static
    {
        if (!$this->productCompatibilities->contains($productCompatibility)) {
            $this->productCompatibilities->add($productCompatibility);
            $productCompatibility->setFuelType($this);
        }

        return $this;
    }

    public function removeProductCompatibility(ProductCompatibility $productCompatibility): static
    {
        if ($this->productCompatibilities->removeElement($productCompatibility)) {
            // set the owning side to null (unless already changed)
            if ($productCompatibility->getFuelType() === $this) {
                $productCompatibility->setFuelType(null);
            }
        }

        return $this;
    }
}
