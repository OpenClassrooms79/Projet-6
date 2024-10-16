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

    public function showError(string $title, string $message, int $httpCode = 200): void
    {
        http_response_code($httpCode);
        $view = new View("Erreur - $title");
        $view->render('includes/error', ['message' => $message]);
        exit;
    }
}