# 1. Prérequis

Pour faire fonctionner ce site il vous faut :

- un serveur Apache (version >= 2.2.x)
- PHP (version >= 8.x)
- MySQL (version >= 8.x)

# 2. Configuration initiale

## 2.1 Apache

Le site utilise utilise la fonctionnalité de réécriture d'URL d'Apache. Il faut donc activer le module correspondant
dans la configuration Apache (fichier `httpd.conf`) puis redémarrer le serveur Apache :  
`LoadModule rewrite_module modules/mod_rewrite.so`

## 2.2  PHP

- Renommez le fichier `_config.php` en `config.php`
- Renseignez les valeurs des constantes :
    - `DB_HOST`
    - `DB_NAME`
    - `DB_USER`
    - `DB_PASS`

## 2.3 MySQL

La structure et les données de la base MySQL sont fournies dans le fichier `database.sql` que vous devez importer dans
une base de données vide (de préférence)

# 3. Script de vérification

Lorsque vous avez terminé la configuration, chargez le fichier `check.php` (à la racine du site) dans votre navigateur
pour vérifier si des problèmes sont détectés.