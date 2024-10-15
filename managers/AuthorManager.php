<?php

class AuthorManager extends AbstractEntityManager
{
    public function insertAuthor(Author $author): Author
    {
        $sql = "SELECT id, first_name, last_name, nickname FROM authors WHERE first_name = :firstName AND last_name= :lastName";
        $res = $this->db->query($sql, [
            'firstName' => $author->getFirstName(),
            'lastName' => $author->getLastName(),
        ]);
        if ($res->rowCount() !== 0) {
            return new Author($res->fetch());
        }

        $sql = "INSERT INTO authors(first_name, last_name, nickname) VALUES (:firstName, :lastName, :nickname)";
        $data = [
            'firstName' => trim($author->getFirstName()),
            'lastName' => trim($author->getLastName()),
            'nickname' => trim($author->getNickname()),
        ];
        $this->db->query($sql, $data);
        $data['id'] = $this->db->getPDO()->lastInsertId();
        return new Author($data);
    }

    public function getTextFromAuthors(array $authors): string
    {
        $texts = [];
        foreach ($authors as $author) {
            $texts[] = trim($author->getFirstName() . ', ' . $author->getLastName() . ', ' . $author->getNickname());
        }
        return implode(';', $texts);
    }

    public function getAuthorsFromText(string $text): array
    {
        $authors = [];
        $parts = explode(';', $text);
        foreach ($parts as $part) {
            $part = trim($part);
            if ($part !== '') {
                $author = explode(',', $part);

                $firstName = $lastName = $nickname = '';
                if (isset($author[0])) {
                    $firstName = trim($author[0]);
                    if (isset($author[1])) {
                        $lastName = trim($author[1]);
                        if (isset($author[2])) {
                            $nickname = trim($author[2]);
                        }
                    }
                }
                $authors[] = new Author([
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'nickname' => $nickname,
                ]);
            }
        }
        return $authors;
    }
}