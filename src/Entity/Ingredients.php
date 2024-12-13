<?php

namespace App\Entity;

use App\Repository\IngredientsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientsRepository::class)]
class Ingredients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $supplier_id = null;

    #[ORM\Column]
    private ?int $category_id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $media_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplierId(): ?int
    {
        return $this->supplier_id;
    }

    public function setSupplierId(int $supplier_id): static
    {
        $this->supplier_id = $supplier_id;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): static
    {
        $this->category_id = $category_id;

        return $this;
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

    public function getMediaId(): ?int
    {
        return $this->media_id;
    }

    public function setMediaId(?int $media_id): static
    {
        $this->media_id = $media_id;

        return $this;
    }
}
