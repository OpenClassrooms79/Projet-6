<?php

class HomeController
{
    public function showHome(): void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getLastBooks();
        //print_r($books);
        //exit;

        $view = new View("Accueil");
        $view->render("accueil", ['books' => $books]);
    }
}