# webrd

Silex Web Framework Skeleton

## Use:

* [Silex](http://silex.sensiolabs.org/)
* [Material Design Lite](https://getmdl.io/)
* [Doctrine DBAL & ORM](http://www.doctrine-project.org/)
* [Swiftmailer](http://swiftmailer.org/)
* [Twig](http://twig.sensiolabs.org/)

## Prérequis:

* composer
* git
* PHP7

## Installation:


    # Cloner le repository
    git clone git@github.com:tuken80/webrd.git
    cd webrd
    # Installer les dépendances avec composer
    composer install
    # Copier le fichier de configuration exemple.
    cp config/parameters.yml.dist config/parameters.yml

***

>**Note**
>Modifier le fichier parameters.yml en fonction de votre configuration et créer la base de données associée.

***


    # Définition des droits sur le répertoire var.
    php bin/console set-permissions
    # Vérification de la sécurité.
    php bin/console check
    # Test de l'environnement de production pour doctrine.
    php vendor/bin/doctrine orm:ensure-production-settings
    # Création de le structure de la base de données en fonction de vos Modeles.
    php vendor/bin/doctrine orm:schema-tool:create
    
***

>**Note**
>Liste de toutes les commandes:

***


    # Console:
    ./bin/console
    # Doctrine:
    ./vendor/bin/doctrine.php
    ./vendor/bin/doctrine-dbal

## Configuration Apache:


    <VirtualHost *:80>
        ServerAdmin exemple@email.com
        ServerName www.example.com
        DocumentRoot "/path/to/webrd/public"
        DirectoryIndex index.php

        <Directory "/path/to/webrd/public/">
            AllowOverride All
            Options Indexes MultiViews FollowSymLinks
            Require all granted

            <IfModule mod_rewrite.c>
                Options -MultiViews
                RewriteEngine On
                #RewriteBase /path/rewrite/base
                RewriteCond %{REQUEST_FILENAME} !-d
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteRule ^ index.php [QSA,L]
            </IfModule>
        </Directory>

        ErrorLog "/var/log/apache2/webrd-error_log"
        CustomLog "/var/log/apache2/webrd-access_log" common
    </VirtualHost>