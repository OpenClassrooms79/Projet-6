<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

print_r($_GET);

$action = $_GET['action'] ?? 'index';

//var_dump($action);

switch ($action) {
    case 'index':
        $view = 'accueil';
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

ob_start();
require sprintf('views/%s.php', $view);
$content = ob_get_clean();

require 'views/main.php';
