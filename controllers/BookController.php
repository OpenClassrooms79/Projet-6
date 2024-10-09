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
        $userManager = new BookManager();
        $book = $userManager->getBookById($bookId);

        $view = new View("");
        $view->render(
            "includes/detail-edit",
            [
                'book' => $book,
            ],
        );
    }
}