<?php
/**
 * @author Jocelyn Flament
 * @since 29/09/2024
 */

class UserController
{
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
                            'email' => $_POST['email'],
                            'password' => $_POST['password'],
                            'nickname' => $_POST['nickname'],
                            'error' => "Le pseudo ou l'adresse e-mail sont déjà utilisés",
                        ],
                    );
                    return;
                }
            } else {
                $view->render(
                    "includes/register",
                    [
                        'email' => $_POST['email'],
                        'password' => $_POST['password'],
                        'nickname' => $_POST['nickname'],
                        'error' => sprintf("Le format de l'adresse e-mail '<kbd>%s</kbd>' n'est pas valide", $_POST['email']),
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

    public function showLogout(): void
    {
        session_destroy();
        header('Location: ./');
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