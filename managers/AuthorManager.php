<?php

class AuthorManager extends AbstractEntityManager
{
    /**
     * Ajout d'un auteur
     *
     * @param Author $author
     * @return int ID de l'auteur ajouté dans la table MySQL
     */
    public function add(Author $author): int
    {
        // ajout de l'auteur
        $sql = "INSERT INTO authors(first_name, last_name, nickname) VALUES (:firstName, :lastName, :nickname)";
        $data = [
            'firstName' => trim($author->getFirstName()),
            'lastName' => trim($author->getLastName()),
            'nickname' => trim($author->getNickname()),
        ];
        $res = $this->db->query($sql, $data);

        if (is_int($res)) {
            if ($res === ER_DUP_ENTRY) {
                // l'auteur existe déjà dans la base (même prénom et nom de famille)
                $sql = "SELECT id, first_name, last_name, nickname FROM authors WHERE first_name = :firstName AND last_name = :lastName";
                $res = $this->db->query($sql, [
                    'firstName' => $author->getFirstName(),
                    'lastName' => $author->getLastName(),
                ]);

                // renvoyer l'ID de l'auteur déjà enregistré dans la base
                return $res->fetchColumn();
            }

            throw new RuntimeException($this->error(self::ERR_INSERT, $res));
        }

        // renvoyer l'ID de l'auteur inséré dans la table MySQL
        return $this->db->getPDO()->lastInsertId();
    }

    /**
     * Récupération d'un auteur
     *
     * @param int $id
     * @return Author
     */
    public function getById(int $id): Author
    {
        $sql = 'SELECT * FROM authors WHERE id = :id';
        $res = $this->db->query($sql, ['id' => $id]);
        if ($res->rowCount() === 1) {
            return new Author($res->fetch(PDO::FETCH_ASSOC));
        }
        throw new RuntimeException(Author::ERR_NOT_FOUND . " (id = $id)");
    }

    /**
     * Mise à jour d'un auteur
     *
     * @param Author $author
     * @return void
     */
    public function update(Author $author): void
    {
        $sql = 'UPDATE authors SET first_name = :firstName, last_name = :lastName, nickname = :nickname WHERE id = :id';
        $res = $this->db->query($sql, [
            'firstName' => $author->getFirstName(),
            'lastName' => $author->getLastName(),
            'nickname' => $author->getNickname(),
        ]);
        if (is_int($res)) {
            throw new RuntimeException($this->error(self::ERR_UPDATE, $res));
        }
    }

    /**
     * Suppression d'un auteur
     *
     * @param int $id ID de l'auteur à supprimer
     * @return void
     */
    public function delete(int $id): void
    {
        $sql = 'DELETE FROM authors WHERE id = :id';
        $res = $this->db->query($sql, ['id' => $id]);
        if (is_int($res)) {
            throw new RuntimeException(self::ERR_DELETE . " (id = $id)");
        }
    }

    /**
     * À partir d'un tableau d'instances de la classe Author, renvoie le texte à placer dans un champ de formulaire au format "Prénom1, Nom1, Pseudo1 ; Prénom2, Nom2, Pseudo2 ; ..."
     */
    public function getTextFromAuthors(array $authors): string
    {
        $texts = [];
        foreach ($authors as $author) {
            $texts[] = trim($author->getFirstName() . ', ' . $author->getLastName() . ', ' . $author->getNickname());
        }
        return implode(';', $texts);
    }

    /**
     * À partir de texte saisi dans un champ de formulaire au format "Prénom1, Nom1, Pseudo1 ; Prénom2, Nom2, Pseudo2 ; ...", renvoie un tableau d'instances de la classe Author
     *
     * @param string $text
     * @return array
     */
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

    /**
     * Supprime tous les auteurs qui ne correspondent à aucun livre de la base
     *
     * @return void
     */
    public function deleteUnusedAuthors(): void
    {
        $sql = 'DELETE a.*
FROM authors a
LEFT JOIN books_authors ba ON a.id = ba.author_id
WHERE ba.author_id IS NULL';
        $this->db->query($sql);
    }
}