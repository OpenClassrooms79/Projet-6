<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/config.php';
require_once 'config/autoload.php';

session_name(SESSION_NAME);
session_start();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        $homeController = new HomeController();
        $homeController->showHome();
        break;

    case 'echanges':
        $bookController = new BookController();
        $bookController->showExchanges();
        break;

    case 'detail':
        $bookController = new BookController();
        $bookController->showDetail($_GET['id']);
        break;

    case 'inscription':
        $userController = new UserController();
        $userController->showRegister();
        break;

    case 'identification':
        $userController = new UserController();
        $userController->showLogin();
        break;

    case 'deconnexion':
        $userController = new UserController();
        $userController->showLogout();
        break;

    case 'messagerie':
        $userController = new UserController();
        $userController->showMessenger();
        break;

    case 'profil':
        $userController = new UserController();
        $userController->showAccount();
        break;

    case 'modifier':
        $bookController = new BookController();
        $bookController->showEditBook($_GET['id']);
        break;

    default:
        $homeController = new HomeController();
        $homeController->showError('page inexistante', 'La page demandée n\'existe pas !', 404);
        break;
}
