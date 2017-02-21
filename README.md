# webrd

Website Framework to www.rduquesne.fr

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

    git clone git@github.com:tuken80/webrd.git
    cd webrd
    composer install
    cp config/parameters.yml.dist config/parameters.yml

* Modifier le fichier parameters.yml en fonction de votre configuration
* Créer la base de données associée.

    ./bin/console check
    ./vendor/bin/doctrine orm:ensure-production-settings
    ./vendor/bin/doctrine orm:schema-tool:create

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