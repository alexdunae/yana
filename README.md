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

## WordPress setup

1. Install WordPress on the remote host
1. Configure Wordpress
    - Thumbnails: 288x (no cropping)
    - Medium images: 309x
    - Large images: 618x
    - Permalinks
1. Install and activate the [Advanced Custom Fields](http://wordpress.org/plugins/advanced-custom-fields/) plugin
    - Import the field definitions from the `advanced-custom-field-export.xml` file in the YANA theme directory
1. Create a post category for "Thank Yous" with the slug `thanks`

TODO: 50% width image
TODO: events 3rd party intro text, no 3rd party links



## Deployment

Make sure everything is looking tight.  Check a few links.  Then, from terminal (in a new tab maybe?):

    bundle exec middleman deploy

## Generating the icon font

The font is generated via [Icomoon.io](http://icomoon.io/app/).  Upload `stylesheets/fonts/icomoon.dev.svg` to that web app to edit the font.
