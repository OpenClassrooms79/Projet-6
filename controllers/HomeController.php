<?php

use JetBrains\PhpStorm\NoReturn;

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

        $view = new View("Accueil");
        $view->render("includes/exchanges", ['books' => $books]);
    }
}