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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/home/mcstrmi/public_html/blog/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'mcstrmi_mcstDb' );

/** Database username */
define( 'DB_USER', 'mcstrmi_McStUsR' );

/** Database password */
define( 'DB_PASSWORD', 'MC7%St0Pw' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'af|AWm=sFE|su~B,oWT1x+.#4#<,!/Mc^0wy !Ut7B-r&o`}A!<%T5ozefBW@&11' );
define( 'SECURE_AUTH_KEY',  'r_;9*dQ;]rX!+ceJZ;A||N5ma}+lN094/D[q!c]v[Ws4dNz5Yky>cdh[pNNTmZ#v' );
define( 'LOGGED_IN_KEY',    'bNBDZsQ4_XY;f4<vc{P2KKU/xE7!6HXJ7D,BR6<?m`1}o6i;n-V_p]mvs4t;R9~g' );
define( 'NONCE_KEY',        'D8R,e!qyTInj1;a<~d-`ufc*?CMj{ZTs95;|m%oG]K!p*B($=>q)v[P91!W5(Vx>' );
define( 'AUTH_SALT',        'yhdEsOH.X{rqDm~ _~x>hHnb>5~+GDNTGJ1^]ge,pcGC0! @~C{JCYLT{)Rwm1Y.' );
define( 'SECURE_AUTH_SALT', 'f+]O_`Omi^YcE&0,R(pN!!QcH5G0bWLlmWpaBy4KS{7ywPP=|Hn8$*{`WHMV)wjX' );
define( 'LOGGED_IN_SALT',   ']$ zQxLNZk[rs1rBB!`EBKLSy-ZSxP?(W_HRgF_YnU(}m~e9O[NG@;f4|>)2:bB6' );
define( 'NONCE_SALT',       ':0Zr-K](o Jvq!,jbPcJKy{?XY|QLTXxS5Hvh`(qDqvE?@d[^>afq@:DMp$l)srx' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
