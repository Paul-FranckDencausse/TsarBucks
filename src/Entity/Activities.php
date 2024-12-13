<?php

namespace App\Entity;

use App\Repository\ActivitiesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivitiesRepository::class)]
class Activities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $association_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $media_id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAssociationId(): ?int
    {
        return $this->association_id;
    }

    public function setAssociationId(int $association_id): static
    {
        $this->association_id = $association_id;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
