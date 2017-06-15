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
define('AUTH_KEY',         'yJ49FLC|zsaB`W;rY,L+9JEOtCWCUM11BD6{5rr4!weY<e<oF&@.[2/N$NK:w`4+');
define('SECURE_AUTH_KEY',  'g(G@EvWLuNU9j-A!xbI;iE/*|Hq3JHlnJ<fct.sd XrJePu.x[9 G>1{X:DQPG&>');
define('LOGGED_IN_KEY',    '?F=q5hH;DoF){6nV NJ`K1!ri<^Y}UpUlP uY%WBvun,Odz1%C,we>: N|kg2+rG');
define('NONCE_KEY',        'fIldKI!a@C|Bs=]jar(@[ocC]vr_+m;xN~3jo.c5aMP6qKvQ2P)QkLccD}n=^6>y');
define('AUTH_SALT',        'E|2Qu}]XamkZ~3</?9nie>vO{Q8-oEde#FKV_S2_(Qk*v_$MS<A$2TMoak`Ft~3|');
define('SECURE_AUTH_SALT', 'LT)Zw$c q0Tk,Jh-Q6{e_eU!~Qn?,^FN2w=6Q2|`f%)Tn-n>]=/ptnyC 2kLxYkf');
define('LOGGED_IN_SALT',   '9+.oHTeCh`[b&l8S6%s<JwW-M&@Wvb4cjhUAO:;j&X2_?3o_*[,WPaojNA swe82');
define('NONCE_SALT',       'SPdD{yz7 ,*h^Qf33s!O<&G=0qf1F 7[f6dKH$?3/j:kc#pLpIlWzVITSY:l)w-T');

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
