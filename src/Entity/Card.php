<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CardRepository::class)
 */
class Card
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Clan::class, inversedBy="cards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clan;

    /**
     * @ORM\Column(type="text")
     */
    private $skill;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url_image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getClan(): ?Clan
    {
        return $this->clan;
    }

    public function setClan(?Clan $clan): self
    {
        $this->clan = $clan;

        return $this;
    }

    public function getSkill(): ?string
    {
        return $this->skill;
    }

    public function setSkill(string $skill): self
    {
        $this->skill = $skill;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUrlImage(): ?string
    {
        return $this->url_image;
    }

    public function setUrlImage(string $url_image): self
    {
        $this->url_image = $url_image;

        return $this;
    }
}
