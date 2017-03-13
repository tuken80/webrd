# Silex-Skeleton:

[Silex](http://silex.sensiolabs.org/) Web Framework Skeleton.

Silex is a PHP micro-framework to develop websites based on [Symfony](https://symfony.com/) components.

## Use:

* [Doctrine DBAL](http://www.doctrine-project.org/)
* [Swiftmailer](http://swiftmailer.org/)
* [Twig](http://twig.sensiolabs.org/)
* [Material Design Lite](https://getmdl.io/)

## Requirements:

* PHP >= 5.5.9
* Composer
* NodeJS
* Git

## Installation:


    # Clone the repository:
    git clone git@github.com:tuken80/webrd.git silex-skeleton
    # Move to folder:
    cd silex-skeleton
    # Copy the configuration file example:
    cp config/parameters.yml.dist config/parameters.yml

***

>**Note**
>Modify the parameters.yml file according to your configuration and create the associated database.

***


    # Launch installation script:
    bash install.sh
    
***

>**Note**
>List of all commands:

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