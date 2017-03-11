# webrd

Silex Web Framework Skeleton

## Use:

* [Silex](http://silex.sensiolabs.org/)
* [Material Design Lite](https://getmdl.io/)
* [Doctrine DBAL](http://www.doctrine-project.org/)
* [Swiftmailer](http://swiftmailer.org/)
* [Twig](http://twig.sensiolabs.org/)

## Prérequis:

* PHP >= 5
* Composer
* NodeJS
* Git

## Installation:


    # Cloner le repository:
    git clone git@github.com:tuken80/webrd.git silex-skeleton
    cd silex-skeleton
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

## Apache:


    <VirtualHost *:80>
        ServerAdmin exemple@domain.tld
        ServerName domain.tld
        ServerAlias www.domain.tld
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
                RewriteRule ^ index.php [QSA,L]
            </IfModule>
        </Directory>

        # Disable mod rewrite to assets.
        <Directory /path/to/silex/public/assets>
            <IfModule mod_rewrite.c>
                RewriteEngine Off
            </IfModule>
        </Directory>

        ErrorLog /path/to/silex/var/logs/apache2/error_log
        CustomLog /path/to/silex/var/logs/apache2/access_log combined
    </VirtualHost>