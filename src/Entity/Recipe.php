<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\BanWord;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Length(min: 10, minMessage: 'Merci de renseigner au moins 10 caractères')]    
    #[Assert\NotBlank(message: 'Merci de renseigner un titre')]
    #[ORM\Column(length: 255)]
    #[BanWord()]
    private ?string $title = '';

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 10, minMessage: 'Merci de renseigner au moins 10 caractères')]
    #[Assert\Regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', message: 'Ceci n\'est pas un slug valide')]
    private ?string $slug = null;

    #[ORM\Column(length: 500)]
    #[Assert\NotBlank(message: 'Les étapes de la recette doivent être complétées')]
    #[Assert\Length(min: 10, max: 500, minMessage: 'Merci de renseigner au moins 10 caractères', maxMessage: 'Merci de ne pas dépasser 500 caractères')]
    private ?string $content = '';

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $createdAt;
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $updatedAt;

    #[ORM\Column(nullable: true)]
    #[Assert\NotBlank(message: 'La durée doit être complétée')]
    #[Assert\Positive(message: 'La durée doit être supérieure à 0.')]
    private ?int $duration = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
    
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }
}
