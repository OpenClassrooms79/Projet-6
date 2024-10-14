<?php

class Book extends AbstractEntity
{
    protected int $id;
    private string $title;
    private string $description;
    private bool $exchangeable;
    private array $authors;
    private User $owner;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->authors = [];
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getImagePath(): string
    {
        return BOOKS_PATH . $this->id;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setExchangeable(bool $exchangeable): void
    {
        $this->exchangeable = $exchangeable;
    }

    public function isExchangeable(): bool
    {
        return $this->exchangeable;
    }

    public function setAuthors(array $authors): void
    {
        $this->authors = $authors;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function setOwner(User $owner): void
    {
        $this->owner = $owner;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function getAuthorsText(): string
    {
        if (count($this->authors) === 0) {
            return '---';
        }

        if (count($this->authors) === 1) {
            return $this->authors[0];
        }

        return implode(', ', array_slice($this->authors, 0, count($this->authors) - 1)) . ' et ' . $this->authors[count($this->authors) - 1];
    }

    public function addAuthor(Author $author): void
    {
        $this->authors[] = $author;
    }
}