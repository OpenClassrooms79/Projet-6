<?php

class AuthorManager extends AbstractEntityManager
{
    public function addAuthor(Author $author): void
    {
        $sql = "INSERT INTO authors(first_name, last_name, nickname) VALUES (:firstName, :lastName, :nickname)";
        $this->db->query($sql, [
            'firstName' => $author->getFirstName(),
            'lastName' => $author->getLastName(),
            'nickname' => $author->getNickname(),
        ]);
    }
}