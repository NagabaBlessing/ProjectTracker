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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress - kanzu' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1:3307' );

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
define( 'AUTH_KEY',         'UX2h~[[<LFN+#:^?D(#rid<7rly0ST[ f?-|)<3}-p~jKWpU0Lp`)|@d6#}I`q@R' );
define( 'SECURE_AUTH_KEY',  'F,<-e*q-9:4=w%<HaXN{_c23KArms41uF@4l#V`wobV>lI6X6l(`Tv:z2YvnHF5N' );
define( 'LOGGED_IN_KEY',    'p4]dkSv)(jV&kDMD.rp`@lR%(Av9gU+li3 Ir]NS|r!zT+Z.(p#2;GN]Y<03Di-C' );
define( 'NONCE_KEY',        '1iwtQx/-H5Yz(k.g:<J[m3^F97n-HMr2)t:ni4:sS>X&W$fk%$X0<m]X]vc.pzu~' );
define( 'AUTH_SALT',        'J,,tZjK_/4I0@0/b)|,]ytNTVGYnKyfc|j(&+La/gp:JQ+@>qW{1O-<!;)ojqXqO' );
define( 'SECURE_AUTH_SALT', 'r-]% +_tkhMF^>V_/JtpAG$;+0D[D27Q?Nmd-fTWRbW@I4Lb{~]xnI.a<zlM_CZa' );
define( 'LOGGED_IN_SALT',   'fE)%rk}2_7s3{d3&(!j92L4eZEF&$Em?]]>pJ#WXgCA^8n^+I*>~<0#!*HKOu*8g' );
define( 'NONCE_SALT',       'FS;q,9> ,w4!1 iy,U8w6T&xK6SdlC.cyihAtBCcQ+]~,cv3>$gwy;/G0{wlD}UA' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
