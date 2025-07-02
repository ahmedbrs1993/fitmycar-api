<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductCompatibilityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductCompatibilityRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['compatibility:read']]
)]
#[ApiFilter(SearchFilter::class, properties: ['fuelType' => 'exact'])]
class ProductCompatibility
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'productCompatibilities')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['compatibility:read'])]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'productCompatibilities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FuelType $fuelType = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getFuelType(): ?FuelType
    {
        return $this->fuelType;
    }

    public function setFuelType(?FuelType $fuelType): static
    {
        $this->fuelType = $fuelType;

        return $this;
    }

    public function __toString(): string
    {
        return sprintf(
            '%s - %s',
            $this->product?->__toString() ?? 'Product',
            $this->fuelType?->__toString() ?? 'FuelType'
        );
    }
}
