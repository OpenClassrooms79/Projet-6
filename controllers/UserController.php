<?php

class UserController
{
    public const ERR_AVATAR_UPDATE = "Une erreur est survenue lors de la mise à jour de l'avatar de l'utilisateur";

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
                    $user->setId($userManager->add($user));
                    Utils::setSession($user->getId());
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
            try {
                $user = $userManager->login($_POST['email'], $_POST['password']);
            } catch (Exception $e) {
                $view->render(
                    "includes/register-login",
                    $variables + [
                        'email' => $_POST['email'],
                        'password' => $_POST['password'],
                        'error' => $e->getMessage(),
                    ],
                );
                return;
            }
            if ($user === null) {
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
            Utils::setSession($user->getId());
            header('Location: profil');
        }
        $view->render("includes/register-login", $variables);
    }

    public function showLogout(): void
    {
        session_destroy();
        Utils::redirectIfNotAuthenticated();
    }

    public function showAccount(): void
    {
        $userManager = new UserManager();
        $bookManager = new BookManager();

        if (isset($_GET['id'])) {
            try {
                $user = $userManager->getById($_GET['id']);
                $view = new View("Profil de " . $user->getNickname());
                $view->render(
                    "includes/account-public",
                    [
                        'user' => $user,
                        'books' => $bookManager->getBooksByUser($user->getId()),
                    ],
                );
            } catch (Exception $e) {
                $homeController = new HomeController();
                $homeController->showError(
                    User::ERR_NOT_FOUND,
                    $e->getMessage(),
                );
            }
        } else {
            Utils::redirectIfNotAuthenticated();

            $error = '';
            $user = Utils::getUserFromSession();

            // suppression du livre
            if (isset($_GET['supprimer'])) {
                $bookManager->delete($_GET['supprimer'], $user->getId());
            }

            if (isset($_POST['update'])) {
                if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK && is_uploaded_file($_FILES['avatar']['tmp_name']) && !move_uploaded_file($_FILES['avatar']['tmp_name'], $user->getCustomAvatarPath())) {
                    $error = self::ERR_AVATAR_UPDATE;
                }

                try {
                    $user->setEmail($_POST['email']);
                    $user->setNickname($_POST['nickname']);

                    // si le mot de passe fourni est vide, on ne le met pas à jour
                    if ($_POST['password'] !== '') {
                        $user->setPassword($_POST['password']);
                    }

                    $userManager->update($user);
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
            }

            $view = new View("Mon compte");
            $view->render(
                "includes/account",
                [
                    'user' => $user,
                    'books' => $bookManager->getBooksByUser($user->getId()),
                    'error' => $error,
                ],
            );
        }
    }

    public function showMessenger(): void
    {
        Utils::redirectIfNotAuthenticated();
        $user = Utils::getUserFromSession();

        $userManager = new UserManager();
        $messageManager = new MessageManager();


        $messageSenders = $messageManager->getMessageSenders($user->getId());
        if (isset($_GET['from'])) {
            $fromId = (int) $_GET['from'];
        } else {
            $fromId = $messageSenders[0]['user_id'];
        }
        $fromUser = $userManager->getById($fromId);

        if (isset($_POST['message'])) {
            $messageManager->add(new Message([
                'fromId' => $user->getId(),
                'toId' => $fromUser->getId(),
                'content' => $_POST['message'],
            ]));
        }


        $view = new View("Messagerie");
        $view->render(
            "includes/messenger",
            [
                'userId' => $user->getId(),
                'fromUser' => $fromUser,
                'messageSenders' => $messageSenders,
                'messages' => $messageManager->getDiscussion($user->getId(), $fromId),
            ],
        );
        $messageManager->setRead($fromId, $user->getId());
    }
}