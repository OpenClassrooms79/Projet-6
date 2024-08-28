<?php

class AuthorManager extends AbstractEntityManager
{
    public function addAuthor(Author $author): void
    {
        $sql = "INSERT INTO authors(firstName, lastName, nickname) VALUES (:firstName, :lastName, :nickname)";
        $this->db->query($sql, [
            'firstName' => $author->getFirstName(),
            'lastName' => $author->getLastName(),
            'nickname' => $author->getNickname()
        ]);
    }
}