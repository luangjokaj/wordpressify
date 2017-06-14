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
define('AUTH_KEY',         '%H_6k!8*cjb(H IM{;nosq`n8|w^vw%lO)&IcafD#95!ntEDTtMg!9d~AH`q[)8M');
define('SECURE_AUTH_KEY',  '9TVmJ$&W&}X6EN`YZb3z`0CVI>]q{E5~>xC zJYdonRbQmPN;~HZyi2l2ow{[zO/');
define('LOGGED_IN_KEY',    'rNqsu_hCZ{3?O6<I-bn:w<h9;!prJ600+s5RLXbNDmzM|Ksy4nW7osutxxhj<_R/');
define('NONCE_KEY',        'c7U|J6+aErg2S77#@{@Yb10X*HTK?b*o=x+%nl(,:-6K|r ^mfbM=p$]57l1,)-F');
define('AUTH_SALT',        'yWeBG47IW%[A!6!MGho0eQR#Q3pM@u`{exXx<{@#99Nsx9|tXQ,-q!ACgBN8U$z9');
define('SECURE_AUTH_SALT', 'PARV-Y% HpgkoRU0*haQ*_[v?)YA3 ?:AKE]zFS3<{G[#X3VV}5d(>}.T}6]AN|b');
define('LOGGED_IN_SALT',   'qasYb<FidRm5rpTZ:I<]L}$(s1faVv)N Fza3<Oh4K<#F<0nia7V&z?{Zb_2J!S$');
define('NONCE_SALT',       'Jq9B%,w?MpDc.@JBrn<@=.=J{9T3F>:eVUm__#X<]_0j7zB~`G~3T#[L3j3Fd=r4');

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
