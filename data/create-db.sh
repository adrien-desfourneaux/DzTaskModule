#!/bin/sh

# /*!
#     Cré la base de données de développement pour le module DzTask
#     @author Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
#  */

# SCRIPTPATH = zf2_app/module/DzTask/data
SCRIPTPATH=$( cd "$(dirname "$0")" ; pwd -P )
cd $SCRIPTPATH

function create_db
{
    rm -f dztask.sqlite;
    cat dztask.sqlite.sql | sqlite3 dztask.sqlite;
    chmod g+w dztask.sqlite
}

printf "Attention! Lancer ce script va supprimer la base de données de développement de DzProject ainsi que tout son contenu.\n";

while true; do
    read -p "Continuer ? " on
    case $on in
        [Oo]* ) create_db; break;;
        [Nn]* ) exit;;
        * ) echo "Repondre par oui ou non.";;
    esac
done
