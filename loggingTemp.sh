#!/bin/bash

TODAY=`date '+%Y%m%d'`

LOGFILENAME=$TODAY.csv
GRAPHFILENAME=$TODAY.png

WEBDIR=/var/www/tempsensor
LOGDIR=$WEBDIR/logfiles
LOGFILE=$LOGDIR/$TODAY.csv

if [ ! -d $LOGDIR ]
then
    mkdir $LOGDIR
fi

python /var/www/tempsensor/readAnalogValues.py >> $LOGFILE

#update graph
curl http://localhost/tempsensor/updateGraph.php
