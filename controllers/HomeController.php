<?php

class HomeController
{
    public function showHome(): void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getLastBooks();

        $view = new View("Accueil");
        $view->render("includes/home", ['books' => $books]);
    }

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

    public function showError(): void
    {
        $view = new View('Erreur : page inexistante');
        $view->render("includes/error");
    }
}