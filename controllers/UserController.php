<?php

class UserController
{
    public function showRegister(): void
    {
        $view = new View("Inscription");
        if (isset($_POST['nickname'], $_POST['email'], $_POST['password'])) {
            // vérifier les données
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL, FILTER_FLAG_EMAIL_UNICODE)) {
                // créer le nouvel utilisateur
                $userManager = new UserManager();
                try {
                    $user = new User($_POST);
                    $user->setId($userManager->addUser($user));
                    $_SESSION['user'] = $user;
                    header('Location: profil');
                } catch (Exception $e) {
                    $view->render(
                        "includes/register",
                        [
                            'email' => $_POST['email'],
                            'password' => $_POST['password'],
                            'nickname' => $_POST['nickname'],
                            'error' => $e->getMessage(),
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
                        'email' => $_POST['email'],
                        'password' => $_POST['password'],
                        'error' => "Adresse e-mail ou mot de passe incorrect",
                    ],
                );
                return;
            }
            $_SESSION['user'] = $result;
            header('Location: profil');
        }
        $view->render("includes/login");
    }

    public function showLogout(): void
    {
        session_destroy();
        header('Location: ./identification');
    }

    public function showAccount(): void
    {
        $userManager = new UserManager();

        if (isset($_GET['id'])) {
            $user = $userManager->getById($_GET['id']);
            $view = new View("");
            $view->render(
                "includes/account-public",
                [
                    'user' => $user,
                    'books' => $userManager->getBooks($user->getId()),
                ],
            );
        } else {
            $error = '';
            $user = $userManager->getById($_SESSION['user']->getId());
            if (isset($_POST['update'])) {
                try {
                    $user->setEmail($_POST['email']);
                    $user->setNickname($_POST['nickname']);

                    // si le mot de passe fourni est vide, on ne le met pas à jour
                    if ($_POST['password'] !== '') {
                        $user->setPassword(new HashedPassword($_POST['password']));
                    }

                    $userManager->save($user);
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
            }
            $user = $userManager->getById($_SESSION['user']->getId());

            $view = new View("Mon compte");
            $view->render(
                "includes/account",
                [
                    'user' => $user,
                    'books' => $userManager->getBooks($user->getId()),
                    'error' => $error,
                ],
            );
        }
    }
}