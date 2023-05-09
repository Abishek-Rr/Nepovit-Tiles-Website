<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'u559962102_nepovit');

/** Database username */
define('DB_USER', 'u559962102_nepovit');

/** Database password */
define('DB_PASSWORD', 'Nepo@1122');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '4a5646c9f249d63bed0f106486931e36aebe3cc0589056a01551f6b450943027');
define('SECURE_AUTH_KEY', 'c5d1cab542ec038c7c7cb5ec6a8139a70f5b48c4ff9d1aeb4eae4d5692213ce9');
define('LOGGED_IN_KEY', '276c5429142af5e2557ebdc2b74dc6fba027d19693b681439f5882c33f03967b');
define('NONCE_KEY', '04b4d68be75c84fa3aa458ff7bad2606945ad2870b30736a63f988a4469575eb');
define('AUTH_SALT', 'e21151de3b46fd63dc28e8aa87bd43ab44c8ad247b484d5604679cc2f2c859e1');
define('SECURE_AUTH_SALT', '399c451f2ebdb6865d211721ab3fa4ceb22e01634b51371c547ab46ff9cfcb94');
define('LOGGED_IN_SALT', 'eaba92be997048a0f8346047c66aa291e0d62b64bc11892eb085c0050d818e82');
define('NONCE_SALT', 'f677543bbeb8e498ab8d55ee13293560a5900f3bc479fd42a1d88b7eb8782aec');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'Qhu_';
define('WP_CRON_LOCK_TIMEOUT', 120);
define('AUTOSAVE_INTERVAL', 300);
define('WP_POST_REVISIONS', 5);
define('EMPTY_TRASH_DAYS', 7);
define('WP_AUTO_UPDATE_CORE', true);

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
