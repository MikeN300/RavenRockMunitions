<?php
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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'jk4LnHDkptoZacn+gvXeFUK8yyMxh4Sa4t/M8Mde/0N10ZodbPYiqJTHi2Ycy+ioGUWOGW3EzsoeDhjSvVYqug==');
define('SECURE_AUTH_KEY',  'AowVZAFOjdnTum0Ro68EZorm94SOoWehN2yhIE+kcfeW0cpJF+YOJhZ9crg6nxi3OlWrUmAPQKbnZd8kUkxxzQ==');
define('LOGGED_IN_KEY',    'clkCmmCcIRPOQ1iUOZwpl7uT4aVCoJgsZYmqBSea38zAFJCUliPbeJIdC5JoBFKqNB89KelYXM+y4wF3ruQXEw==');
define('NONCE_KEY',        '7AlZxIUoHe6K/QJ+15m99zyZqLRRxWLlrpv+vUji8cVmtSeLfWgEkwqS0rFMB89psI68mhIw/fSq9JUu7kYVvA==');
define('AUTH_SALT',        'KLIeTdgtOJKglRmDW4nyRVoBuF/50YSd3+UZkUhCfDd3E1DdJhsV2LTaHKRaMQI5UAfVt0DjRifLVdXv3zYMrw==');
define('SECURE_AUTH_SALT', 'LV90c3qctV6svTOePPzI/Tv+MjzuBnpe+61Lp2raf3OfWOPWEsPBMLY0LsIiVTpacB71FicJGvCv3CTZknhLNQ==');
define('LOGGED_IN_SALT',   'CF0fOxKmvbj0BlAFNdVG1dGvjnNwEdh5nwhnNpFLec/KOQet4n8nf6gd71swcBfi2RIw/Ij9f8d1CfnjeRLePg==');
define('NONCE_SALT',       'VQJkk1RvjphpwWAe/2imKd+vUQnJfbMbWciqG28y4ioVRnmfiSzC5ivBbdBdnmMdQ/Wgi06eGqSG9+DLsqb1hA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';





/* Inserted by Local by Flywheel. See: http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy */
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}

/* Inserted by Local by Flywheel. Fixes $is_nginx global for rewrites. */
if ( ! empty( $_SERVER['SERVER_SOFTWARE'] ) && strpos( $_SERVER['SERVER_SOFTWARE'], 'Flywheel/' ) !== false ) {
	$_SERVER['SERVER_SOFTWARE'] = 'nginx/1.10.1';
}
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
