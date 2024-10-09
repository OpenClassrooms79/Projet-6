<?php

class BookManager extends AbstractEntityManager
{
    public const NB_LAST_BOOKS = 4;

    public function addBook(Book $book): void
    {
        $sql = "INSERT INTO books(title, image, description, exchangeable) VALUES (:title, :image, :description, :exchangeable)";
        $this->db->query($sql, [
            'title' => $book->getTitle(),
            'image' => $book->getImage(),
            'description' => $book->getDescription(),
            'exchangeable' => $book->isExchangeable(),
        ]);

        $authors = $book->getAuthors();
        $sql = "INSERT INTO books_authors(book_id, author_id) VALUES (:book_id, :author_id)";
        foreach ($authors as $author) {
            $this->db->query($sql, [
                'book_id' => $book->getId(),
                'author_id' => $author->getId(),
            ]);
        }
    }

    public function getBookById(int $id): Book
    {
        $sql = 'SELECT b.*, a.id AS author_id, a.first_name, a.last_name, a.nickname, u.id AS owner_id, u.nickname AS owner_nickname, u.avatar
FROM (
	SELECT *
	FROM books
	WHERE id = :id
) b
LEFT JOIN books_authors ba ON b.id = ba.book_id
LEFT JOIN authors a ON ba.author_id = a.id
LEFT JOIN users u ON b.owner_id = u.id';
        $result = $this->db->query($sql, ['id' => $id]);

        $book = null;

        while ($record = $result->fetch()) {
            if (!isset($book)) {
                $data = [
                    'id' => $record['id'],
                    'title' => $record['title'],
                    'image' => $record['image'],
                    'description' => $record['description'],
                    'exchangeable' => $record['exchangeable'],
                    'owner' => new User(
                        [
                            'id' => $record['owner_id'],
                            'nickname' => $record['owner_nickname'],
                            'avatar' => $record['avatar'],
                        ],
                    ),
                ];
                $book = new Book($data);
            }

            $data = [
                'id' => $record['author_id'],
                'firstName' => $record['first_name'],
                'lastName' => $record['last_name'],
                'nickname' => $record['nickname'],
            ];
            $author = new Author($data);
            $book->addAuthor($author);
        }
        return $book;
    }

    public function getAllBooks(): array
    {
        $sql = 'SELECT b.*, a.id AS author_id, a.first_name, a.last_name, a.nickname, u.id AS owner_id, u.nickname AS owner_nickname
FROM (
	SELECT *
	FROM books
	ORDER BY id ASC
) b
LEFT JOIN books_authors ba ON b.id = ba.book_id
LEFT JOIN authors a ON ba.author_id = a.id
LEFT JOIN users u ON b.owner_id = u.id';
        $result = $this->db->query($sql);

        return $this->getBooks($result);
    }

    public function getFilteredBooks(string $search): array
    {
        $sql = 'SELECT b.*, a.id AS author_id, a.first_name, a.last_name, a.nickname, u.id AS owner_id, u.nickname AS owner_nickname
FROM (
	SELECT *
	FROM books
	WHERE title LIKE :search
	ORDER BY id ASC
) b
LEFT JOIN books_authors ba ON b.id = ba.book_id
LEFT JOIN authors a ON ba.author_id = a.id
LEFT JOIN users u ON b.owner_id = u.id';
        $result = $this->db->query($sql, ['search' => "%$search%"]);

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

    protected function getBooks(PDOStatement $result): array
    {
        $books = [];

        while ($record = $result->fetch()) {
            if (!isset($books[$record['id']])) {
                $data = [
                    'id' => $record['id'],
                    'title' => $record['title'],
                    'image' => $record['image'],
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

            $data = [
                'id' => $record['author_id'],
                'firstName' => $record['first_name'],
                'lastName' => $record['last_name'],
                'nickname' => $record['nickname'],
            ];
            $author = new Author($data);
            $books[$record['id']]->addAuthor($author);
        }
        return $books;
    }
}