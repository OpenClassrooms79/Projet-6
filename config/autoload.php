<?php

/**
 * Système d'autoload.
 * A chaque fois que PHP va avoir besoin d'une classe, il va appeler cette fonction
 * et chercher dans les divers dossiers s'il trouve
 * un fichier avec le bon nom. Si c'est le cas, il l'inclut avec require_once.
 */
spl_autoload_register(static function ($className) {
    $directories = [
        'core',
        'services',
        'models',
        'controllers',
        'views',
    ];

    foreach ($directories as $directory) {
        // On va voir dans le dossier si la classe existe.
        $path = $directory . '/' . $className . '.php';
        if (file_exists($path)) {
            require_once $path;
            break;
        }
    }
});