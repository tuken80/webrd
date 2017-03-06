#!/bin/bash

# Installation de composer:
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '55d6ead61b29c7bdee5cccfb50076874187bd9f21f65d8991d46ec5cc90518f447387fb9f76ebae1fbbacf329e583e30') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php --install-dir=bin --filename=composer
php -r "unlink('composer-setup.php');"

# Installation des dépendances php via composer:
# Rajouter --no-dev pour la production.
php bin/composer install

# Installation de UglifyJS2 & UglifyCSS via Node:
npm install

# Définition des droits:
HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
echo "L'utilisateur apache est: $HTTPDUSER"

WHOAMI=`whoami`
echo "L'utilisateur courant est: $WHOAMI"

UNAME=`uname`
echo "Définition des droits sur var:"
echo "Systême: $UNAME."

if [[ "$UNAME" == 'Linux' ]]; then
    sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:"$WHOAMI":rwX var && sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:"$WHOAMI":rwX var && echo "Pour les utilisateurs $HTTPDUSER et $WHOAMI: OK."
elif [[ "$UNAME" == 'Darwin' ]]; then
    sudo chmod -R +a "$HTTPDUSER allow delete,write,append,file_inherit,directory_inherit" var && echo "Pour l'utilisateur $HTTPDUSER: OK."
    sudo chmod -R +a "$WHOAMI allow delete,write,append,file_inherit,directory_inherit" var && echo "Pour l'utilisateur $WHOAMI: OK."
else
    echo "Systême: $UNAME inconnu pour le script." >&2 && exit 1
fi

# Création du schéma de la base de données:
#php vendor/bin/doctrine orm:schema-tool:create

exit 0