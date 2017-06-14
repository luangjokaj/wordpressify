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
define('AUTH_KEY',         '*NF U;AjVTmSYH4~BP_S|Ql|@~Y)8pi]R28dx}w+eM|d>i_-RAbS,?k4cb^]Uogq');
define('SECURE_AUTH_KEY',  'M8*%?~#P[E.dJ,r-G02>}`$Ta0B*9Jv+4K5bKA4ndiu/2 4X4jxP#fVPD=TJ5yc-');
define('LOGGED_IN_KEY',    '2@% EATD}XcE9m3I{qn.%CK&Md{`*3<od_~u{H*#RyekUV@PMD)CEM?s)sjR{Li:');
define('NONCE_KEY',        'qlN=<k@HKNJE8ORS4.4I=@DN kae/+{P=>r gA8PC.9eQ0rm6!99nV!k0W@ZNP+f');
define('AUTH_SALT',        'O.tYky}$k],FbPi;MpUPQ+WiY~vA6q}JV<Nhd28,jS#IYYda5y63:vw?A<* G]kA');
define('SECURE_AUTH_SALT', 'vMm$&b5.SxWhxV:Y_%*IgOV(nq2e_x|pN3nOfv_L$v{QCMP%i&S]`H 4_ ,E(5f{');
define('LOGGED_IN_SALT',   '@a)JDc^.j+lRV `jlnzdeIOG+HbQ$b91aaN]d@C{R|$5v5jagzb0046ayf _(o{t');
define('NONCE_SALT',       ']Q*2kN5r6T}idG67C.s,#VI<18:zsRO[@tk,vBzWV,T1~;y{y]g!G&i T8(#HP5<');

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
