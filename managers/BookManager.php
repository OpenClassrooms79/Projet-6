<?php

class BookManager extends AbstractEntityManager
{
    public const NB_LAST_BOOKS = 4;

    public function addBook(Book $book): void
    {
        $sql = "INSERT INTO books(title, description, exchangeable) VALUES (:title, :description, :exchangeable)";
        $this->db->query($sql, [
            'title' => $book->getTitle(),
            'description' => $book->getDescription(),
            'exchangeable' => $book->isExchangeable(),
        ]);

        $sql = "INSERT INTO books_authors(book_id, author_id) VALUES (:book_id, :author_id)";
        foreach ($book->getAuthors() as $author) {
            $this->db->query($sql, [
                'book_id' => $book->getId(),
                'author_id' => $author->getId(),
            ]);
        }
    }

    public function getBookById(int $id): Book
    {
        $sql = 'SELECT b.*, a.id AS author_id, a.first_name, a.last_name, a.nickname, u.id AS owner_id, u.nickname AS owner_nickname
FROM books b
LEFT JOIN books_authors ba ON b.id = ba.book_id
LEFT JOIN authors a ON ba.author_id = a.id
LEFT JOIN users u ON b.owner_id = u.id
WHERE b.id = :id';
        $result = $this->db->query($sql, ['id' => $id]);

        return $this->getBooks($result)[$id];
    }

    public function getExchangeableBooks(string $search = ''): array
    {
        if ($search !== '') {
            $condition = 'AND title LIKE :search';
            $params = ['search' => "%$search%"];
        } else {
            $condition = '';
            $params = [];
        }

        $sql = "SELECT b.*, a.id AS author_id, a.first_name, a.last_name, a.nickname, u.id AS owner_id, u.nickname AS owner_nickname
FROM books b
LEFT JOIN books_authors ba ON b.id = ba.book_id
LEFT JOIN authors a ON ba.author_id = a.id
LEFT JOIN users u ON b.owner_id = u.id
WHERE exchangeable = 1 $condition
ORDER BY b.id";
        $result = $this->db->query($sql, $params);

        return $this->getBooks($result);
    }

    public function getLastBooks(): array
    {
        $sql = sprintf(
            'SELECT b.*, a.id AS author_id, a.first_name, a.last_name, a.nickname, u.id AS owner_id, u.nickname AS owner_nickname
FROM (
	SELECT *
	FROM books
	ORDER BY id DESC
	LIMIT %d
) b
LEFT JOIN books_authors ba ON b.id = ba.book_id
LEFT JOIN authors a ON ba.author_id = a.id
LEFT JOIN users u ON b.owner_id = u.id',
            self::NB_LAST_BOOKS,
        );
        $result = $this->db->query($sql);

        return $this->getBooks($result);
    }

    public function getBooksByUser(int $ownerId): array
    {
        $sql = 'SELECT b.*, a.id AS author_id, a.first_name, a.last_name, a.nickname, u.id AS owner_id, u.nickname AS owner_nickname
FROM books b
LEFT JOIN books_authors ba ON b.id = ba.book_id
LEFT JOIN authors a ON ba.author_id = a.id
LEFT JOIN users u ON b.owner_id = u.id
WHERE owner_id = :ownerId';
        $res = $this->db->query($sql, ['ownerId' => $ownerId]);
        return $this->getBooks($res);
    }

    protected function getBooks(PDOStatement $result): array
    {
        $books = [];

        while ($record = $result->fetch()) {
            if (!isset($books[$record['id']])) {
                $data = [
                    'id' => $record['id'],
                    'title' => $record['title'],
                    'description' => $record['description'],
                    'exchangeable' => $record['exchangeable'],
                    'owner' => new User(
                        [
                            'id' => $record['owner_id'],
                            'nickname' => $record['owner_nickname'],
                        ],
                    ),
                ];
                $books[$record['id']] = new Book($data);
            }

            if ($record['author_id'] !== null) {
                $data = [
                    'id' => $record['author_id'],
                    'firstName' => $record['first_name'],
                    'lastName' => $record['last_name'],
                    'nickname' => $record['nickname'],
                ];
                $author = new Author($data);
                $books[$record['id']]->addAuthor($author);
            }
        }
        return $books;
    }

    /**
     * @throws Exception
     */
    public function save(Book $book): bool
    {
        $sql = 'UPDATE books SET title = :title, description = :description, exchangeable = :exchangeable WHERE id = :id';
        $res = $this->db->query($sql, [
            'id' => $book->getId(),
            'title' => $book->getTitle(),
            'description' => $book->getDescription(),
            'exchangeable' => $book->isExchangeable(),
        ]);
        if (is_int($res)) {
            throw new RuntimeException('Impossible de mettre à jour les données', $res);
        }

        // mise à jour des auteurs du livre
        $sql = 'DELETE FROM books_authors WHERE book_id = :id';
        $this->db->query($sql, ['id' => $book->getId()]);
        foreach ($book->getAuthors() as $author) {
            $sql = 'INSERT INTO books_authors (book_id, author_id) VALUES (:book_id, :author_id)';
            $this->db->query($sql, [
                'book_id' => $book->getId(),
                'author_id' => $author->getId(),
            ]);
        }
        $authorManager = new AuthorManager();
        $authorManager->deleteUnusedAuthors();

        return true;
    }
}