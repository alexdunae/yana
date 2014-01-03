#!/bin/sh
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
echo "Finished deploying to $HOST"
