<?php

const TEMPLATE_VIEW_PATH = './views/'; // Le chemin vers les templates de vues.
const MAIN_VIEW_PATH = TEMPLATE_VIEW_PATH . 'main.php'; // Le chemin vers le template principal.
const COMPONENTS_PATH = 'views/components/';

const IMG_PATH = 'img/';
const AVATARS_PATH = IMG_PATH . 'avatars/';
const BOOKS_PATH = IMG_PATH . 'books/';
const ICONS_PATH = IMG_PATH . 'icons/';

const DEFAULT_AVATAR = 'default.png';
const DB_HOST = '';
const DB_NAME = '';
const DB_USER = '';
const DB_PASS = '';
const SESSION_NAME = 'tomtroc';

// Longueur maximale de la description d'un livre affichée sur les pages de profil utilisateur
const BOOK_DESC_MAX_LENGTH = 88;

// codes d'erreur MySQL : https://dev.mysql.com/doc/mysql-errors/8.4/en/server-error-reference.html
const ER_DUP_ENTRY = 1062;