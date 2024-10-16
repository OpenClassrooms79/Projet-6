<?php

class BookController
{
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
        $book = $bookManager->getBookById($bookId);

        $view = new View("Détail d'un livre : " . $book->getTitle());
        $view->render("includes/detail", ['book' => $book]);
    }

    public function showEditBook(int $bookId): void
    {
        Utils::redirectIfNotConnected();

        $authorManager = new AuthorManager();
        $bookManager = new BookManager();
        $userManager = new UserManager();

        $book = $bookManager->getBookById($bookId);
        $user = $userManager->getById($_SESSION['user']->getId());

        if ($book->getOwner()->getId() !== $user->getId()) {
            $homeController = new HomeController();
            $homeController->showError('accès interdit', "Vous ne pouvez pas modifier ce livre car il ne vous appartient pas.", 403);
        }

        if (isset($_POST['update-book'])) {
            if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK && is_uploaded_file($_FILES['cover']['tmp_name'])) {
                if (!move_uploaded_file($_FILES['cover']['tmp_name'], $book->getImagePath())) {
                    // TODO gérer erreur
                }
            }

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