<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
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
define( 'DB_NAME', 'myastrowalk');

/** Database username */
define( 'DB_USER', 'root');

/** Database password */
define( 'DB_PASSWORD', 'Amit@8006');

/** Database hostname */
define( 'DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8');

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '');

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
define('WP_HOME', 'http://13.232.43.140');
define('WP_SITEURL', 'http://13.232.43.140');
define( 'AUTH_KEY',         'IF(JeUSt+:ToGWKkVP6SBm_Yz,6-G;hoZ{GbCOV76jO2ZoI!GtOO3[yOdSGq]+j?' );
define( 'SECURE_AUTH_KEY',  '9mlhm_[B`#{8XHQ{unw!oe=la,/IP2syV@l` W3_Hq7cRf88;r(HyW5<-V@Fd,sZ' );
define( 'LOGGED_IN_KEY',    'EVj0{Yt3mwbG+GUq(8zRxyw|&JW0Za+u2Ek)pe2_vl1~TQU-)<AN#*ip.5c.dO=y' );
define( 'NONCE_KEY',        '{2>1x^T3Y-sHY!<6W9tsqJHX98Zntl<RZ~L|,Y#W22Z=4{~1g+!T&7~0nKal}13s' );
define( 'AUTH_SALT',        '/u31pI/a*eAB:?!a;4}O^F(b{9{b<+hLb0.{6b;!E|=jjN2i]ywES6EI=E1laC`K' );
define( 'SECURE_AUTH_SALT', 'migYlD<Jh]FDqh-xj-0~Bwg3N9,KMi1[F6&g96pQYun`Ll#_?M`0Bx^AW2>h*I>D' );
define( 'LOGGED_IN_SALT',   'b|M[-q,e~<IZE;80@!@RYBU/Mc(agtuY|CG1l.xZQ4w^xYv,g<OjjwLdFhCgNP8^' );
define( 'NONCE_SALT',       'NIzkOQHmc}x@F?{My0=>yp3 IRMGy; Y;:XP/h&JXly(bOg|: jV[bghq!jNv0k)' );

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
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
define('FS_METHOD','direct');
