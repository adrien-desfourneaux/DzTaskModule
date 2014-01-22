#!/bin/sh

# /*!
#     Run all tests for the DzTask module.
#     @author Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
#  */

# SCRIPTPATH = zf2_app/module/DzTask/script
SCRIPTPATH=$( cd "$(dirname "$0")" ; pwd -P )
cd $SCRIPTPATH/..
../../vendor/bin/phpspec run
../../vendor/bin/codecept run
