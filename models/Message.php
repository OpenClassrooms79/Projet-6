<?php

class Message extends AbstractEntity
{
    protected int $id;
    private int $fromId;
    private int $toId;
    private string $text;
    private DateTime $created;
    private bool $isRead;

    public function setFromId(int $fromId): void
    {
        $this->fromId = $fromId;
    }

    public function getFromId(): int
    {
        return $this->fromId;
    }

    public function setToId(int $toId): void
    {
        $this->toId = $toId;
    }

    public function getToId(): int
    {
        return $this->toId;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function setIsRead(bool $isRead): void
    {
        $this->isRead = $isRead;
    }

    public function isRead(): bool
    {
        return $this->isRead;
    }
}