<?php

require_once 'config/config.php';

if (!in_array('mod_rewrite', apache_get_modules(), true)) {
    die('ERREUR : Le module "mod_rewrite" n\'est pas chargé.');
}

try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

const TABLES = ['authors', 'books', 'books_authors', 'messages', 'users'];
$sth = $db->prepare('SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ?');
$sth->execute([DB_NAME]);
$db_tables = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
$missing_tables = array_diff(TABLES, $db_tables);
if (!empty($missing_tables)) {
    die('ERREUR : certaines tables sont manquantes : ' . implode(', ', $missing_tables));
}

echo 'La configuration du site semble correcte.';