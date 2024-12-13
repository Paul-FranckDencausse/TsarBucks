<?php

namespace App\Entity;

use App\Repository\RecipesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipesRepository::class)]
class Recipes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ingredient_id = null;

    #[ORM\Column]
    private ?int $media_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIngredientId(): ?int
    {
        return $this->ingredient_id;
    }

    public function setIngredientId(int $ingredient_id): static
    {
        $this->ingredient_id = $ingredient_id;

        return $this;
    }

    public function getMediaId(): ?int
    {
        return $this->media_id;
    }

    public function setMediaId(int $media_id): static
    {
        $this->media_id = $media_id;

        return $this;
    }
}
