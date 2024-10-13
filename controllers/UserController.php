<?php

class UserController
{
    public function showRegister(): void
    {
        $view = new View("Inscription");
        $variables = [
            'h1' => 'Inscription',
            'button_text' => "S'inscrire",
            'button_name' => 'register',
            'bottom_text' => 'Déjà inscrit ?',
            'bottom_url' => 'identification',
            'bottom_link' => 'Connectez-vous',
        ];

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
                        "includes/register-login",
                        $variables + [
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
                    "includes/register-login",
                    $variables + [
                        'email' => $_POST['email'],
                        'password' => $_POST['password'],
                        'nickname' => $_POST['nickname'],
                        'error' => sprintf("Le format de l'adresse e-mail '<kbd>%s</kbd>' n'est pas valide", $_POST['email']),
                    ],
                );
                return;
            }
        }
        $view->render("includes/register-login", $variables);
    }

    public function showLogin(): void
    {
        $view = new View("Identification");
        $variables = [
            'h1' => 'Connexion',
            'button_text' => 'Se connecter',
            'button_name' => 'login',
            'bottom_text' => 'Pas de compte ?',
            'bottom_url' => 'inscription',
            'bottom_link' => 'Inscrivez-vous',
        ];

        if (isset($_POST['email'], $_POST['password'])) {
            // vérifier les données
            $userManager = new UserManager();
            $result = $userManager->login($_POST['email'], $_POST['password']);
            if ($result === false) {
                $view->render(
                    "includes/register-login",
                    $variables + [
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
        $view->render("includes/register-login", $variables);
    }

    public function showLogout(): void
    {
        session_destroy();
        Utils::redirectIfNotConnected();
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
            Utils::redirectIfNotConnected();

            $error = '';
            $user = $userManager->getById($_SESSION['user']->getId());
            if (isset($_POST['update'])) {
                try {
                    $user->setEmail($_POST['email']);
                    $user->setNickname($_POST['nickname']);

                    // si le mot de passe fourni est vide, on ne le met pas à jour
                    if ($_POST['password'] !== '') {
                        $user->setPassword($_POST['password']);
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