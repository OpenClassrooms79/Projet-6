<?php

class Book extends AbstractEntity
{
    protected int $id;
    private string $title;
    private string $image;
    private string $description;
    private bool $exchangeable;
    private array $authors;

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

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getImage(): string
    {
        return $this->image;
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

    public function setAuthors(array $authors): Book
    {
        $this->authors = $authors;
        return $this;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function addAuthor(Author $author): void
    {
        $this->authors[] = $author;
    }
}