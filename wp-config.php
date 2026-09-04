<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
define('WP_AUTO_UPDATE_CORE', 'minor');// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u305984835_srioms' );

/** MySQL database username */
define( 'DB_USER', 'u305984835_srioms' );

/** MySQL database password */
define( 'DB_PASSWORD', '@User_2001' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'va4ngjeb1hauiuvj0m6qm4ftrv04vf7gdozwd1gzzlpmqbvclg9cmkotlkme6f2h' );
define( 'SECURE_AUTH_KEY',  'j97cembrnluvtepi27dy20eo3pnifbgbtoohzesgrdbibcwlqoflly2pdo5rg539' );
define( 'LOGGED_IN_KEY',    'oj0uvdevceuzj2e0aeqq83jys9bbcpezmaasq7ptkzuiql5tu6rjerstywigeex6' );
define( 'NONCE_KEY',        'qalauouborkopfzmbhquk9xuu2wcwf9bvdujugfprlvcicytzjyadysdupqzqeno' );
define( 'AUTH_SALT',        'hkfz0m3vilpnzx640e3szb4sp66r62zjus6og3kwh2g8xcml7xo8yaw4smwy5m6r' );
define( 'SECURE_AUTH_SALT', 'h9gvardqnnxpi5ntfwkw9crcmrfc3dsokk2xigrc6jlwe073objc8txaqfwk8esd' );
define( 'LOGGED_IN_SALT',   'pfxkigzixmuowdrp1vojrjujvnlwjje0srbsftdgefebnowrv7wrusxhbwmojroc' );
define( 'NONCE_SALT',       'v8x3xu1mdtj05iaeie31aoedbi0vhisk50o4evijycpazgg3y99nenpeqmudxbmm' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
