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
}
