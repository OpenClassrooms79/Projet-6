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
        if (isset($_POST['nickname'], $_POST['email'], $_POST['password'])) {
            // vérifier les données
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                // créer le nouvel utilisateur
                $userManager = new UserManager();
                $res = $userManager->addUser(new User([
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'nickname' => $_POST['nickname'],
                ]));
                if ($res === false) {
                    $view->render(
                        "includes/register",
                        [
                            'error' => "Le pseudo ou l'adresse e-mail existe déjà dans la base",
                        ],
                    );
                    return;
                }
            } else {
                $view->render(
                    "includes/register",
                    [
                        'error' => sprintf("Le format de l'adresse e-mail <kbd>%s</kbd> n'est pas valide", $_POST['email']),
                    ],
                );
                return;
            }
        }
        $view->render("includes/register");
    }

    public function showLogin(): void
    {
        $view = new View("Identification");

        if (isset($_POST['email'], $_POST['password'])) {
            // vérifier les données
            $userManager = new UserManager();
            $result = $userManager->login($_POST['email'], $_POST['password']);
            if ($result === false) {
                $view->render(
                    "includes/login",
                    [
                        'error' => "Adresse e-mail ou mot de passe incorrect",
                    ],
                );
                return;
            }
            $_SESSION['member'] = $result;
            header('Location: profil');
        }
        $view->render("includes/login");
    }

    public function showAccount(): void
    {
        $userManager = new UserManager();

        if (isset($_GET['id'])) {
            $member = $userManager->getById($_GET['id']);
            $view = new View("");
            $view->render(
                "includes/account-public",
                [
                    'member' => $member,
                    'books' => $userManager->getBooks($member->getId()),
                ],
            );
        } else {
            $member = $userManager->getById($_SESSION['member']->getId());
            $view = new View("Mon compte");
            $view->render(
                "includes/account",
                [
                    'member' => $member,
                    'books' => $userManager->getBooks($member->getId()),
                ],
            );
        }
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