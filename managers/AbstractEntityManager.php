<?php

/**
 * Classe abstraite qui représente un manager. Elle récupère automatiquement le gestionnaire de base de données.
 */
abstract class AbstractEntityManager
{
    const ERR_INSERT = "Erreur MySQL %d : impossible d'ajouter les données";
    //const ERR_READ = ;
    const ERR_UPDATE = 'Impossible de mettre à jour les données (code : %d)';
    const ERR_DELETE = 'Impossible de supprimer les données (code : %d)';

    protected DBManager $db;

    /**
     * Constructeur de la classe.
     * Il récupère automatiquement l'instance de DBManager.
     */
    public function __construct()
    {
        $this->db = DBManager::getInstance();
    }

    public function error(string $message, int $code): string
    {
        return sprintf($message, $code);
    }
}