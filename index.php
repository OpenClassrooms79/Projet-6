<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/config.php';
require_once 'config/autoload.php';

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        $homeController = new HomeController();
        $homeController->showHome();
        break;

    case 'echange':
        break;

    case 'messagerie':
        break;

    case 'compte':
        break;

    case 'connexion':
        break;

    default:
        // page 404
        break;
}
