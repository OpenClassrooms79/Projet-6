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

    public function showError(): void
    {
        header('HTTP/1.0 404 Not Found');
        $view = new View('Erreur : page inexistante');
        $view->render("includes/error");
    }
}