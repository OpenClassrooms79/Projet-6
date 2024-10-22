<?php

class Author extends AbstractEntity
{
    public const ERR_NOT_FOUND = 'auteur inexistant';

    protected int $id;
    private string $firstName;
    private string $lastName;
    private string $nickname;

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setNickname(?string $nickname): void
    {
        $this->nickname = $nickname ?? '';
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function __toString()
    {
        return trim($this->firstName . ' ' . $this->lastName . (empty($this->nickname) ? '' : ' (' . $this->nickname . ')'));
    }
}