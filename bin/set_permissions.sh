#!/bin/bash

HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
echo "L'utilisateur apache est: $HTTPDUSER"

WHOAMI=`whoami`
echo "L'utilisateur courant est: $WHOAMI"

UNAME=`uname`
echo "Définition des droits sur var:"
echo "Systême: $UNAME."
if [[ "$UNAME" == 'Linux' ]]; then
    sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:"$WHOAMI":rwX var
    sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:"$WHOAMI":rwX var
    echo "Pour les utilisateurs $HTTPDUSER et $WHOAMI: OK."
elif [[ "$UNAME" == 'Darwin' ]]; then
    sudo chmod -R +a "$HTTPDUSER allow delete,write,append,file_inherit,directory_inherit" var
    echo "Pour l'utilisateur $HTTPDUSER: OK."
    sudo chmod -R +a "$WHOAMI allow delete,write,append,file_inherit,directory_inherit" var
    echo "Pour l'utilisateur $WHOAMI: OK."
else
    echo "Systême: $UNAME inconnu pour le script."
    exit 1
fi

exit 0
