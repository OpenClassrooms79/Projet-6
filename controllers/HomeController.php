<?php

class HomeController
{
    public function showHome(): void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getLastBooks();

        $view = new View("Accueil");
        $view->render("includes/accueil", ['books' => $books]);
    }

    public function showExchanges(): void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks();

        $view = new View("Nos livres à l’échange");
        $view->render("includes/exchanges", ['books' => $books]);
    }

    public function showDetail(int $bookId): void
    {
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($bookId);

        $view = new View("Détail d'un livre : " . $book->getTitle());
        $view->render("includes/detail", ['book' => $book]);
    }

    public function showRegister(): void
    {
        $view = new View("Inscription");
        $view->render("includes/register");
    }

    public function showLogin(): void
    {
        $view = new View("Identification");
        $view->render("includes/login");
    }
}