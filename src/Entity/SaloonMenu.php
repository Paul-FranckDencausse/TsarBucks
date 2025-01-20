<?php

namespace App\Entity;

use App\Repository\SaloonMenuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaloonMenuRepository::class)]
class SaloonMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $saloon_id = null;

    #[ORM\Column]
    private ?int $menu_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageFilename = null;
    

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(nullable: true)]
    private ?int $recipeId = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSaloonId(): ?int
    {
        return $this->saloon_id;
    }

    public function setSaloonId(int $saloon_id): static
    {
        $this->saloon_id = $saloon_id;

        return $this;
    }

    public function getMenuId(): ?int
    {
        return $this->menu_id;
    }

    public function setMenuId(int $menu_id): static
    {
        $this->menu_id = $menu_id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

   
public function getImageFilename(): ?string
{
    return $this->imageFilename;
}

public function setImageFilename(?string $imageFilename): static
{
    $this->imageFilename = $imageFilename;

    return $this;
}
    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getRecipeId(): ?int
    {
        return $this->recipeId;
    }

    public function setRecipeId(?int $recipeId): static
    {
        $this->recipeId = $recipeId;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

}
