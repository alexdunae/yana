#!/bin/sh
ROOTDIR="www"
BASEDIR="www/wp-content/themes/yana"
USER="dialect"
HOST="dialect.ca"
rsync -rvzt --delete --delete-excluded --executability \
      --exclude=.DS_Store \
      --exclude=.svn \
      --exclude=.git \
      --exclude=css/ \
      --exclude=*.coffee \
      $BASEDIR $USER@$HOST:/home/dialect/yana.dialect.ca/wp-content/themes/
scp $ROOTDIR/favicon.ico $USER@$HOST:/home/dialect/yana.dialect.ca/
echo "Finished deploying to $HOST"
