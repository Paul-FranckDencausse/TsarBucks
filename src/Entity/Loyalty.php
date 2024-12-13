<?php

namespace App\Entity;

use App\Repository\LoyaltyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoyaltyRepository::class)]
class Loyalty
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\Column(length: 255)]
    private ?string $rewards = null;

    #[ORM\Column]
    private ?int $money_spent = null;

    #[ORM\Column(length: 255)]
    private ?string $starred = null;

    #[ORM\Column(nullable: true)]
    private ?int $media_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function getRewards(): ?string
    {
        return $this->rewards;
    }

    public function setRewards(string $rewards): static
    {
        $this->rewards = $rewards;

        return $this;
    }

    public function getMoneySpent(): ?int
    {
        return $this->money_spent;
    }

    public function setMoneySpent(int $money_spent): static
    {
        $this->money_spent = $money_spent;

        return $this;
    }

    public function getStarred(): ?string
    {
        return $this->starred;
    }

    public function setStarred(string $starred): static
    {
        $this->starred = $starred;

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
