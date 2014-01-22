#!/bin/sh

# /*!
#     Run metrics generation for the DzTask module.
#     @author Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
#  */

# SCRIPTPATH = zf2_app/module/DzTask/script
SCRIPTPATH=$( cd "$(dirname "$0")" ; pwd -P )
cd $SCRIPTPATH/..
../../vendor/bin/pdepend --summary-xml="metrics/summary.xml" \
                         --jdepend-chart="metrics/jdepend.svg" \
                         --overview-pyramid="metrics/pyramid.svg" \
                         .
../../vendor/bin/phploc --progress . > metrics/stats.txt
