<?php

class Message extends AbstractEntity
{
    public const ERR_NOT_FOUND = 'message inexistant';

    protected int $id;
    private int $fromId;
    private int $toId;
    private string $content;
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

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setCreated(string $created): void
    {
        try {
            $this->created = new DateTime($created);
        } catch (Exception $e) {
            // TODO gérer exception
        }
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