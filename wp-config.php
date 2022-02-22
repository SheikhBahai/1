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
define( 'DB_NAME', 'site' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'Z-%-1h]@Luyr#w!>5>%^6!/.0-[CAc8S`V[H/%S5]~f)7ZG{K;cQt({X/zHELLZD' );
define( 'SECURE_AUTH_KEY',  'P|<1mz&%;&taA>0f$%-F9I[bULxVVhmN2q1*UUfc^s~:R!sA~<c})q[pWUTNqMv1' );
define( 'LOGGED_IN_KEY',    '2QWe]v5q]ofHF*aUeX%<w82[ZDz<nQ{v.&*M5sS:=+p>CZ/GoOnm]| 92_cB%T_y' );
define( 'NONCE_KEY',        '*GNi-RtxK8dABXJCm=a&jLQy&C>t^I$Gj<wY~GyYH,P~7$Sz+~0$%JOv8i_n^CXC' );
define( 'AUTH_SALT',        'OOWvUc*OkwicQ%wf :ULo7XLPRr;BgtZ_A+rI{k8#..eZtMisk`!aNkI^n>o!<&I' );
define( 'SECURE_AUTH_SALT', 't{nLDacY[ ~_zo_?z~r(9*iS$jGIpL_nSu5a=4_-ZoHM~J*Ro74qPDq/FP4OrzGJ' );
define( 'LOGGED_IN_SALT',   'qp_6a5G3r3Y`g;SU[x*5UZW6,K.vx= wQ6_&(`V./{w<qF,6{ <ZZ/NNkh;>s7so' );
define( 'NONCE_SALT',       'P $,^b^$9cJ~y?$Ss]P#YAd1`nzF6Jx8E_/#yT08mh@t^3eKSVQQ_Ia=xAxTIs(}' );

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
