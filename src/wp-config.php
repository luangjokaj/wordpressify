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
define('DB_NAME', 'sql11180790');

/** MySQL database username */
define('DB_USER', 'sql11180790');

/** MySQL database password */
define('DB_PASSWORD', 'cuHPria2em');

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
define('AUTH_KEY',         '=r]-[L{)5LuWA%o4Dp+lXa0|C~?N;/d}NI$d26leNp!e[<@Gt5S&uTe8&ApuDx4q');
define('SECURE_AUTH_KEY',  'QC.>r8[%S-(YB(uk$77@{!o4nD(#K`/>9*n1|bt!+Og5}_7.HEt(63~LDK=y{cPd');
define('LOGGED_IN_KEY',    '%<`E7ktq@70k_^bCk$KN.qT?B(e2${]LiX6CF:mS&sY:HI(X<wDF~hg>Q[?U!#sI');
define('NONCE_KEY',        '2Z2U}t, zBl,tMb/u-[zi;Hh=CNwjVIXm.ADtdEhZreCPrPS3}#q*mfhG?$kF?Kj');
define('AUTH_SALT',        'mZ2wkec=sWz{r!BG}8G+7d=g6&ZSLmvE[+lk<z9xvv.g+8MmiGJct)Ds3WS!~>q]');
define('SECURE_AUTH_SALT', 'seLSjAQGA>ifh]Ddr@nGYx_I>p#LU0` {BV_N[Y)m:>5~Ye6tZ;JndF$VM#}c-f,');
define('LOGGED_IN_SALT',   '(exQ71J-95in>>Js9:Hkg/9l<4xqv7+(Ce}MIXt@48o~?0*n#ux.v@ec)fQXdHtc');
define('NONCE_SALT',       '7v9xrR=^hDYZ}`D-A6Su$t46|/g[Tcz?g=tyG<)tKDMR(syl@GvAy ERuZ0NFSJV');

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
