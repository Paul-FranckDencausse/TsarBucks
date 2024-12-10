<?php
namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prénom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $media_id = null;

    #[ORM\Column(length: 255)]
    private ?string $mot_de_passe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrénom(): ?string
    {
        return $this->prénom;
    }

    public function setPrénom(string $prénom): static
    {
        $this->prénom = $prénom;

        return $this;
    }

    public function getMediaId(): ?string
    {
        return $this->media_id;
    }

    public function setMediaId(?string $media_id): static
    {
        $this->media_id = $media_id;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse(string $mot_de_passe): static
    {
        $this->mot_de_passe = $mot_de_passe;

        return $this;
    }

    // Obligatoire pour PasswordAuthenticatedUserInterface
    public function getPassword(): ?string
    {
        return $this->mot_de_passe;
    }

    // Obligatoire pour UserInterface
    public function getRoles(): array
    {
        // Par défaut, tous les utilisateurs ont le rôle ROLE_USER
        return ['ROLE_USER'];
    }

    // Obligatoire pour UserInterface
    public function getUserIdentifier(): string
    {
        // On utilise l'email comme identifiant unique
        return $this->email;
    }

    // Obligatoire pour UserInterface
    public function eraseCredentials(): void
    {
        // Si tu as des données sensibles dans l'entité, tu peux les effacer ici
    }
}
