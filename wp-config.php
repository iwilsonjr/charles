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
define('DB_NAME', 'iwilson_production');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'v{+|qj5Dqry[U8#Q2R6[SS-qQpnce#/mo9BtTgN$%*v(- rW_qkmemTKq8{N4Z7d');
define('SECURE_AUTH_KEY',  'TcjA0HbRH=> FP*VS_ o]9-&UiKyV+{u86<B7jlOOH.K&b5p}#g1J}d<u}^IA+(~');
define('LOGGED_IN_KEY',    '4^!n;~^)d_e^afD=:Q)(YBoG ]CvDYV^P;JeYhJ^;|YufY}CzV6sTi90H&pFAwf;');
define('NONCE_KEY',        'oxh=qOnXg*x7q!&x[C>@C%_Z6@F+Y]R0];ArFM#Mk.e.vSZUf}lhzEPAbf@ki9LY');
define('AUTH_SALT',        '#lw::&6A?0<He`Z<9ObhP=E^:NwgW}@i^t*uR2!?EDq)DzEw~[R1Pudws<$6?tBI');
define('SECURE_AUTH_SALT', '#r[iVX[Btymrv{UTr(38cu` W#i/S8c+0]VZgwv;/RY29iw=Ar~Ug=S@Kn_uKe4O');
define('LOGGED_IN_SALT',   '8H(KVh^<#MkKf^xj2=-N[z~~I5oO2w?n/RhAFji:vg}Tgr|7B5Hf<Ly?VT1+~]D]');
define('NONCE_SALT',       '6e^j{=K:UU,Rdvy]$&33n!fl4^oy%k(kHSjz]1kQ=Z_{j5%`mg:WGxX-<xEV]M T');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'twp_';

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
