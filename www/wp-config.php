<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/yana/www/wordpress');
define('WP_HOME', 'http://' . $_SERVER['SERVER_NAME'] . '/yana/www');
define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/yana/www/wp-content');
define('WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/yana/www/wp-content');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'yana');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^G gExm${&fWiN [k{qQ3;%*jAU|D=9/$9#>c;-$6Fzv[a&b846{RtIhEK=/ku|4');
define('SECURE_AUTH_KEY',  'dkbr(zlWL|:gS,QVn!G[9g}F<@o~OSy3eKxv$pddh`V&KYh+-LND@|DqQqfM 0bd');
define('LOGGED_IN_KEY',    't-|u3!yH8bNxw7)FZ7K^I)8 m-(7}T{(<g^KNqIqd*96fz/}0{y@lQs?U,A_7y*)');
define('NONCE_KEY',        'N)T^&+?|jwAuFlLU/l-%pz.qRpaT<Tk -yI?{5%5~j}c/I7M>OC kN,KgIkna8)+');
define('AUTH_SALT',        '*]v1>$J[Yl0t8H4c:l47![po{1nz/RqZ>sQ_R}A:gL|HgIA!E7s=~r&}xd-])|Km');
define('SECURE_AUTH_SALT', '{cQ.[IQ0$[>hACVfBy)qj|3a@CRM552.w.h|xG+3Tq)H9!Tk@=!J%f2@He*-/13H');
define('LOGGED_IN_SALT',   'c7ZkwOBp`f~0mLsM7VSI9EIiUt_m{bywrp0RVwg&~OxkqOC2O,|qfBkdIy9ZQ*QB');
define('NONCE_SALT',       'VI_25@?8&^EmIh7DlA3jbH`)(j(+@~9hMf~R=1.`@c+mizA277hU/O+Cn|+VV)zR');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
