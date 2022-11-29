<?php

namespace App\Entity;

use App\Repository\PrimarchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PrimarchRepository::class)
 */
class Primarch
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"primarch_basic_info"})
     * @Serializer\Expose():
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"primarch_basic_info"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"primarch_basic_info"})
     */
    private $chapter;

    /**
     * @ORM\ManyToMany(targetEntity=Book::class, mappedBy="primarch")
     */
    private $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

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

    public function getChapter(): ?string
    {
        return $this->chapter;
    }

    public function setChapter(string $chapter): self
    {
        $this->chapter = $chapter;

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->addPrimarch($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            $book->removePrimarch($this);
        }

        return $this;
    }
}
