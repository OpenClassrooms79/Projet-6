<?php

class Components
{
    public static function get(string $name): string
    {
        $file = COMPONENTS_PATH . $name . '.php';
        if (file_exists($file)) {
            $args = array_slice(func_get_args(), 1, null, true);
            ob_start();
            require_once $file;
            $name(...$args);
            return ob_get_clean();
        }
        throw new RuntimeException("Le composant '$name' est introuvable.");
    }
}
