<?php

class BookController
{
    public const ERR_COVER_UPDATE = "Une erreur est survenue lors de la mise à jour de l'image de couverture du livre";

    public function showExchanges(): void
    {
        $bookManager = new BookManager();
        if (isset($_GET['search'])) {
            $books = $bookManager->getExchangeableBooks($_GET['search']);
        } else {
            $books = $bookManager->getExchangeableBooks();
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
        try {
            $book = $bookManager->getById($bookId);
            $view = new View("Détail d'un livre : " . $book->getTitle());
            $view->render("includes/detail", ['book' => $book]);
        } catch (Exception $e) {
            $homeController = new HomeController();
            $homeController->showError(
                Book::ERR_NOT_FOUND,
                $e->getMessage(),
            );
        }
    }

    public function showEditBook(int $bookId): void
    {
        Utils::redirectIfNotAuthenticated();

        $user = Utils::getUserFromSession();
        $authorManager = new AuthorManager();
        $bookManager = new BookManager();
        $homeController = new HomeController();
        $error = '';

        try {
            $book = $bookManager->getById($bookId);
        } catch (Exception $e) {
            $homeController->showError(
                Book::ERR_NOT_FOUND,
                $e->getMessage(),
            );
            exit;
        }


        if ($book->getOwner()->getId() !== $user->getId()) {
            $homeController->showError(
                'accès interdit',
                "Vous ne pouvez pas modifier ce livre car il ne vous appartient pas.",
                403,
            );
        }

        if (isset($_POST['update-book'])) {
            if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK && is_uploaded_file($_FILES['cover']['tmp_name']) && !move_uploaded_file($_FILES['cover']['tmp_name'], $book->getImagePath())) {
                $error = self::ERR_COVER_UPDATE;
            }

            try {
                $authors = $authorManager->getAuthorsFromText($_POST['authors']);
                $book->setAuthors([]);
                foreach ($authors as $author) {
                    $author->setId($authorManager->add($author));
                    $book->addAuthor($author);
                }
                $book->setTitle($_POST['title']);
                $book->setDescription($_POST['description']);
                $book->setExchangeable($_POST['availability']);
                $bookManager->update($book);
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
                'error' => $error,
            ],
        );
    }
}