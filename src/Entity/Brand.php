<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[UniqueEntity(fields: ['name'], message: 'This name already exists.')]
#[ORM\Entity(repositoryClass: BrandRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['brand:simple']]
)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['brand:simple'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Groups(['brand:simple'])]
    private ?string $name = null;

    /**
     * @var Collection<int, Model>
     */
    #[ORM\OneToMany(targetEntity: Model::class, mappedBy: 'brand', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $models;

    public function __construct()
    {
        $this->models = new ArrayCollection();
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

    /**
     * @return Collection<int, Model>
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(Model $model): static
    {
        if (!$this->models->contains($model)) {
            $this->models->add($model);
            $model->setBrand($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getBrand() === $this) {
                $model->setBrand(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name ?? '';
    }
}
