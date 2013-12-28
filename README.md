# YANA Web Site

## Development

First time:

    cd ~/Sites/yana
    brew update
    brew install node

    npm install -g grunt-cli
    npm install

In terminal:

    cd ~/Sites/yana
    grunt watch

Preview the site at [localhost/yana/www](http://localhost/yana/www/).

Everything relating to the site in progress is in the `www/wp-content/themes/yana` directory.


## WordPress and version control

WordPress is a git submodule.  We don't deploy any of the core WP files, just the theme (TODO: and plugins?).

To upgrade the local version of WordPress to whatever is the latest, run:

    cd wordpress
    git checkout master
    git pull

To upgrade the local version of WordPress to a tagged release, run:

    cd wordpress
    git fetch --tags
    git checkout 3.7


## Deployment

Make sure everything is looking tight.  Check a few links.  Then, from terminal (in a new tab maybe?):

    bundle exec middleman deploy

## Generating the icon font

The font is generated via [Icomoon.io](http://icomoon.io/app/).  Upload `stylesheets/fonts/icomoon.dev.svg` to that web app to edit the font.
