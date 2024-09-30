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
        $homeController = new HomeController();
        $homeController->showExchanges();
        break;

    case 'detail':
        $homeController = new HomeController();
        $homeController->showDetail($_GET['id']);
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
        break;

    case 'profil':
        $userController = new UserController();
        $userController->showAccount();
        break;

    case 'modifier':
        $userController = new UserController();
        $userController->showEditBook($_GET['id']);
        break;

    default:
        $homeController = new HomeController();
        $homeController->showError();
        break;
}
