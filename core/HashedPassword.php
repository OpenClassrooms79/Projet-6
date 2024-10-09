<?php

class HashedPassword
{
    protected string $hash;

    public function __construct($password)
    {
        if ($password !== '') {
            $this->setHash($password);
        } else {
            throw new LengthException('Le mot de passe ne peut pas être vide');
        }
    }

    private function setHash($password): void
    {
        $this->hash = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getHash(): string
    {
        return $this->hash;
    }
}