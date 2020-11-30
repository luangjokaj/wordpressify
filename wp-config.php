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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

/** The name of the database for WordPress */
define( 'DB_NAME', '{{DB_NAME}}' );

/** MySQL database username */
define( 'DB_USER', '{{DB_USER}}' );

/** MySQL database password */
define( 'DB_PASSWORD', '{{DB_PASSWORD}}' );

/** MySQL hostname */
define( 'DB_HOST', '0.0.0.0:{{DB_PORT}}' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '#yo:M S<w![p_j!45pvr@R_jJRL@L hal.:V0zdYYCfiI(wLBWY.P0~MHZ8~FG#}' );
define( 'SECURE_AUTH_KEY',  'Un4&pt^=I:vFO||)8<XI^rj/00%c0->um@(?m]]t;5=UP^M$41B9]<^s[QI>~i&p' );
define( 'LOGGED_IN_KEY',    'o9E}sZ#o7wcVOc~gN/~JW~jWN7![|j->4|WCk(MS}Zj_Qa(;OCG+hw=?)1{(vJDM' );
define( 'NONCE_KEY',        'Z8mnN0LgF@i/oVbR/-B@.=~/$03-Bk,LN9 i+ugSC= J#VQMrB:-erun6dqXPhiZ' );
define( 'AUTH_SALT',        'B-(VfG*wT1-thHgvcg=>Zh8x_{I`c$$8;{]`Zj<?jSMq CHpGpqR|-#XU4n%NWi.' );
define( 'SECURE_AUTH_SALT', 'XI]=V.(BC@Nl2)i)`*5A~&GriGE+[=Q)j|[KwN_b[o1+gbC-qh.$#d{^upYV+{4A' );
define( 'LOGGED_IN_SALT',   '*=Co5O;Mg)iVGCD8?M&y|50%J^tg$jMqtSuC]_rm6iU3SToxVcy4A2.M,~>-Le$$' );
define( 'NONCE_SALT',       '%$FL!g{~ie34U^j9F%T!|m(@Y;Fh[P-rnw!mQ:5?`hs+HJ(sHTSJml}6m#7)R}PE' );

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
  define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
