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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'sql11179756');

/** MySQL database username */
define('DB_USER', 'sql11179756');

/** MySQL database password */
define('DB_PASSWORD', 'jI2BXbTrW8');

/** MySQL hostname */
define('DB_HOST', 'sql11.freesqldatabase.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '+Tje/E,kjQC2OSvn,1se2FzE~@b!t![Tg[wK8H^->,Z }6(jYB;43y+g)A>({D`%');
define('SECURE_AUTH_KEY',  'qk,F!GBra-B^N9ZlI6[|AxAV]Oy!~<Ql-r3>q4`dH>?.D|V5z}!EZNMev>m9F/S7');
define('LOGGED_IN_KEY',    'nxv.<MUt|?;de8Z, R>t1d]!7X[WR:{W!t+,<R/6meSg3+c))=Hrr<K~m-Lg/[G%');
define('NONCE_KEY',        '1{y_jSm;g_Z^>g:OJXH^YcW^8a--R1XDd2n%K?*9eovenjD<sx`dj04&*cL*897_');
define('AUTH_SALT',        'VYMxk;|?o<+Z6dTSO.ZYC!)fEZZdJT2Y*C;(-(zOHooG%ZT-]Pnq@#d{itAuCK~B');
define('SECURE_AUTH_SALT', '`glx^KG4Tn)X#NDVp#,[tZ;BP4UQ VutTe1-!(_BO#<x!#qpiLqeuwXXkihT^kzJ');
define('LOGGED_IN_SALT',   '{+R?)Tu=Le|385@=z5l,2LpCaO:j%>hJIrf_&1FwaIygh-FsWe28:*DIA%b:}2-`');
define('NONCE_SALT',       'b$OCdxXI3{Xy)K?3tUN/u6,n:n7Y-<>En|YY-,`A`_u~WDWpOa}-ZncNyJMK`GMT');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
