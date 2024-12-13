<?php

namespace App\Entity;

use App\Repository\TranslationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TranslationsRepository::class)]
class Translations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $table_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $column_name = null;

    #[ORM\Column(nullable: true)]
    private ?int $row_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $translated_text = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTableName(): ?string
    {
        return $this->table_name;
    }

    public function setTableName(?string $table_name): static
    {
        $this->table_name = $table_name;

        return $this;
    }

    public function getColumnName(): ?string
    {
        return $this->column_name;
    }

    public function setColumnName(?string $column_name): static
    {
        $this->column_name = $column_name;

        return $this;
    }

    public function getRowId(): ?int
    {
        return $this->row_id;
    }

    public function setRowId(?int $row_id): static
    {
        $this->row_id = $row_id;

        return $this;
    }

    public function getTranslatedText(): ?string
    {
        return $this->translated_text;
    }

    public function setTranslatedText(?string $translated_text): static
    {
        $this->translated_text = $translated_text;

        return $this;
    }
}
