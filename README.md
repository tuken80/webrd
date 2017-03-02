# webrd

Silex Web Framework Skeleton

## Use:

* [Silex](http://silex.sensiolabs.org/)
* [Material Design Lite](https://getmdl.io/)
* [Doctrine DBAL & ORM](http://www.doctrine-project.org/)
* [Swiftmailer](http://swiftmailer.org/)
* [Twig](http://twig.sensiolabs.org/)

## Prérequis:

* Git
* Composer
* NodeJS
* PHP >= 5

## Installation:


    # Cloner le repository:
    git clone git@github.com:tuken80/webrd.git
    cd webrd
    # Copier le fichier de configuration exemple:
    cp config/parameters.yml.dist config/parameters.yml

***

>**Note**
>Modifier le fichier parameters.yml en fonction de votre configuration et créer la base de données associée.

***


    # Lancement du script d'installation:
    bash install.sh
    
***

>**Note**
>Liste de toutes les commandes:

***


    # Console:
    php bin/console
    # Doctrine:
    php vendor/bin/doctrine

## Apache:


    <VirtualHost *:80>
        ServerAdmin exemple@domain.tld
        ServerName domain.tld
        ServerAlias www.domain.tld

        # DirectoryIndex:
        # index.php pour la production
        # index_dev.php pour le développement (accessible uniquement en local)
        DirectoryIndex index.php

        DocumentRoot /path/to/silex/public
        <Directory /path/to/silex/public>
            AllowOverride None
            Options Indexes MultiViews FollowSymLinks
            Require all granted

            <IfModule mod_rewrite.c>
                Options -MultiViews
                RewriteEngine On
                #RewriteBase /path/rewrite/base
                RewriteCond %{REQUEST_FILENAME} !-d
                RewriteCond %{REQUEST_FILENAME} !-f
                # RewriteRule:
                # index.php pour la production
                # index_dev.php pour le développement
                RewriteRule ^ index.php [QSA,L]
            </IfModule>
        </Directory>

        # On désactive la réécriture d'url pour les assets.
        <Directory /path/to/silex/public/assets>
            <IfModule mod_rewrite.c>
                RewriteEngine Off
            </IfModule>
        </Directory>

        ErrorLog "/var/log/apache2/application-error_log"
        CustomLog "/var/log/apache2/application-access_log" common
    </VirtualHost>