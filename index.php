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
        $homeController = new HomeController();
        $homeController->showRegister();
        break;

    case 'identification':
        $homeController = new HomeController();
        $homeController->showLogin();
        break;

    case 'messagerie':
        break;

    case 'compte':
        $homeController = new HomeController();
        $homeController->showAccount();
        break;

    default:
        // page 404
        break;
}
