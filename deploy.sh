#!/bin/sh
ROOTDIR="www"
BASEDIR="www/wp-content/themes/yana"
USER="yana"
HOST="yanacomoxvalley.com"
rsync -rvzt --delete --delete-excluded --executability \
      --exclude=.DS_Store \
      --exclude=.svn \
      --exclude=.git \
      --exclude=css/ \
      --exclude=*.coffee \
      $BASEDIR $USER@$HOST:/home/yana/www/wp-content/themes/
scp $ROOTDIR/favicon.ico $USER@$HOST:/home/yana/www/
echo "Finished deploying to $HOST"
