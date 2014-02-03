#!/bin/sh

# /*!
#     Utilitaire pour la base de données de développement du module DzTask
#     @author Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
#  */

function cdscriptpath
{
	# SCRIPTPATH = zf2_app/module/DzTask/data
	SCRIPTPATH=$( cd "$(dirname "$0")" ; pwd -P )
	cd $SCRIPTPATH
}

function confirm
{
	while true; do
	    read -p "Continuer ? " on
	    case $on in
	        [Oo]* ) break;;
	        [Nn]* ) exit;;
	        * ) echo "Repondre par oui ou non.";;
	    esac
	done
}

function create
{	
	cdscriptpath;

	if [ -f dztask.sqlite ]; then
		printf "Attention! Lancer ce script va supprimer la base de données de développement de DzTask ainsi que tout son contenu.\n";
		confirm;
    	
    	rm dztask.sqlite;
    fi
    
    cat dztask.sqlite.sql | sqlite3 dztask.sqlite;
    chmod g+w dztask.sqlite
}

function dump
{
	create;

	cdscriptpath;

	cat dztask.dump.sqlite.sql | sqlite3 dztask.sqlite;
}

function help
{
	printf "Usage: db.sh [action]\n";
	printf "help\taffiche cette aide\n"
	printf "create\tcre la base de donnees\n";
	printf "dump\tcre la base de donnees et y met les données de développement\n";
}

if [ $# -eq 0 ]; then help; fi
if [ "$1" = "help" ]; then help; fi
if [ "$1" = "create" ]; then create; fi
if [ "$1" = "dump" ]; then dump; fi