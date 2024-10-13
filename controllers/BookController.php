<?php

class BookController
{
    public function showExchanges(): void
    {
        $bookManager = new BookManager();
        if (isset($_GET['search'])) {
            $books = $bookManager->getFilteredBooks($_GET['search']);
        } else {
            $books = $bookManager->getAllBooks();
        }

        $view = new View("Nos livres à l’échange");
        $view->render("includes/exchanges", [
            'books' => $books,
            'search' => $_GET['search'] ?? '',
        ]);
    }

    public function showDetail(int $bookId): void
    {
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($bookId);

        $view = new View("Détail d'un livre : " . $book->getTitle());
        $view->render("includes/detail", ['book' => $book]);
    }

    public function showEditBook(int $bookId): void
    {
        Utils::redirectIfNotConnected();

        $authorManager = new AuthorManager();
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($bookId);

        if (isset($_POST['update-book'])) {
            try {
                $authors = $authorManager->getAuthorsFromText($_POST['authors']);
                $book->setAuthors([]);
                foreach ($authors as $author) {
                    $author = $authorManager->insertAuthor($author);
                    $book->addAuthor($author);
                }
                $book->setTitle($_POST['title']);
                $book->setDescription($_POST['description']);
                $book->setExchangeable($_POST['availability']);
                $bookManager->save($book);
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        $view = new View("Modification d'un livre : " . $book->getTitle());
        $view->render(
            "includes/detail-edit",
            [
                'book' => $book,
                'authors' => $authorManager->getTextFromAuthors($book->getAuthors()),
            ],
        );
    }
}