<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $yearOfRelease;

    /**
     * @ORM\Column(type="integer")
     */
    private $orderOfRelease;

    /**
     * @ORM\Column(type="text")
     */
    private $summary;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cover;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subSerie;

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

    public function getYearOfRelease(): ?string
    {
        return $this->yearOfRelease;
    }

    public function setYearOfRelease(string $yearOfRelease): self
    {
        $this->yearOfRelease = $yearOfRelease;

        return $this;
    }

    public function getOrderOfRelease(): ?int
    {
        return $this->orderOfRelease;
    }

    public function setOrderOfRelease(int $orderOfRelease): self
    {
        $this->orderOfRelease = $orderOfRelease;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getSubSerie(): ?string
    {
        return $this->subSerie;
    }

    public function setSubSerie(string $subSerie): self
    {
        $this->subSerie = $subSerie;

        return $this;
    }
}
