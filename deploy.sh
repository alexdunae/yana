#!/bin/sh
ROOTDIR="www"
BASEDIR="www/wp-content/themes/yana"
USER="yanacomoxvalley"
HOST="yanacomoxvalley.com"
rsync -rvzt --delete --delete-excluded --executability --omit-dir-times \
      --exclude=.DS_Store \
      --exclude=.svn \
      --exclude=.git \
      --exclude=css/ \
      --exclude=*.coffee \
      $BASEDIR $USER@$HOST:/home/yanacomoxvalley/yanacomoxvalley.com/wp-content/themes/
scp $ROOTDIR/favicon.ico $USER@$HOST:/home/yanacomoxvalley/yanacomoxvalley.com/
echo "Finished deploying to $HOST"
