#!/bin/bash -eu

# Run this script with HOST=sshhost DIR=targetdir src/deploy.sh

# Composer's location
COMPOSER=/usr/local/bin/composer

grunt compass
git archive master | bzip2 | ssh "$HOST" "cd $DIR; bunzip2 | tar -xf -; $COMPOSER install"
tar -cjf - src/Resources/data/cv.yml htdocs/css/* | ssh "$HOST" "tar -xjf - -C $DIR; rm -rf $DIR/cache/twig/*"

echo "Deploy done, don't forget to refresh the pdf manually"
