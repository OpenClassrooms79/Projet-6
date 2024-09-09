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

    public function getAllBooks(): array
    {
        $sql = 'SELECT b.*, a.id AS author_id, a.firstName, a.lastName, a.nickname
FROM (
	SELECT *
	FROM books
	ORDER BY id ASC
) b
LEFT JOIN books_authors ba ON b.id = ba.book_id
LEFT JOIN authors a ON ba.author_id = a.id';
        $result = $this->db->query($sql);

        $books = [];

        while ($record = $result->fetch()) {
            if (!isset($books[$record['id']])) {
                $data = [
                    'id' => $record['id'],
                    'title' => $record['title'],
                    'image' => $record['image'],
                    'description' => $record['description'],
                    'exchangeable' => $record['exchangeable'],
                ];
                $books[$record['id']] = new Book($data);
            }

            $data = [
                'id' => $record['author_id'],
                'firstName' => $record['firstName'],
                'lastName' => $record['lastName'],
                'nickname' => $record['nickname'],
            ];
            $author = new Author($data);
            $books[$record['id']]->addAuthor($author);
        }
        return $books;
    }

    public function getLastBooks(): array
    {
        $sql = sprintf(
            'SELECT b.*, a.id AS author_id, a.firstName, a.lastName, a.nickname
FROM (
	SELECT *
	FROM books
	ORDER BY id DESC
	LIMIT %d
) b
LEFT JOIN books_authors ba ON b.id = ba.book_id
LEFT JOIN authors a ON ba.author_id = a.id',
            self::NB_LAST_BOOKS,
        );
        $result = $this->db->query($sql, []);

        $books = [];

        while ($record = $result->fetch()) {
            if (!isset($books[$record['id']])) {
                $data = [
                    'id' => $record['id'],
                    'title' => $record['title'],
                    'image' => $record['image'],
                    'description' => $record['description'],
                    'exchangeable' => $record['exchangeable'],
                ];
                $books[$record['id']] = new Book($data);
            }

            $data = [
                'id' => $record['author_id'],
                'firstName' => $record['firstName'],
                'lastName' => $record['lastName'],
                'nickname' => $record['nickname'],
            ];
            $author = new Author($data);
            $books[$record['id']]->addAuthor($author);
        }
        return $books;
    }
}