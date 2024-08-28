<?php

class Message extends AbstractEntity
{
    protected int $id;
    private int $fromId;
    private int $toId;
    private string $text;
    private DateTime $created;
    private bool $isRead;

    public function setFromId(int $fromId): Message
    {
        $this->fromId = $fromId;
        return $this;
    }

    public function getFromId(): int
    {
        return $this->fromId;
    }

    public function setToId(int $toId): Message
    {
        $this->toId = $toId;
        return $this;
    }

    public function getToId(): int
    {
        return $this->toId;
    }

    public function setText(string $text): Message
    {
        $this->text = $text;
        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setCreated(DateTime $created): Message
    {
        $this->created = $created;
        return $this;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function setIsRead(bool $isRead): Message
    {
        $this->isRead = $isRead;
        return $this;
    }

    public function isRead(): bool
    {
        return $this->isRead;
    }
}