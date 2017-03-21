<?php

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/Users/ivanwilson/Documents/Projects/charles/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'thewilsonproject');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost:8889');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '1Ae4O61f>;NP^kB+vT@(hII->>uOng`(28_ bw<8P=h0BYA% G6-$JECC+BZ[Ej?');
define('SECURE_AUTH_KEY',  'g0>wg`-(;:$.iYO}!chxW4>ga{}5%>A+!?;_-f}7]|X(XmW1;@H(#[bq-d.z-P3T');
define('LOGGED_IN_KEY',    '`0Uo1;aoL#C36~b4byK>#^mB6#l|k7HP!Ru/*jq4.-$Ot_>|w(1KcTmLF^zcAX.%');
define('NONCE_KEY',        'E6+z5bb-ZG&REwU9CuID~hCC{*//XpUz#:/J7V/n;-!P/E==CV~Q|+2xDA&GZNl5');
define('AUTH_SALT',        'd:B.3FNb> pC_ ..4%3pj^(V)f/4Xj2}xbTiLz|MQl_xHMt6|;EW$+}AEZWe%tDi');
define('SECURE_AUTH_SALT', '6*PH#ukw>S1Veb+wrkNz;-|e#T`VokUg:kfl`8qj|L@E(!dHnp)I=D5lM_?uc%<.');
define('LOGGED_IN_SALT',   'scu|y(/7R:FM+bbxNB^/[-*qAKsku4E,-`Mist8SE!epX_V^1gRi91F.A[wm}_H+');
define('NONCE_SALT',       '=2#%)qt-65NkTBIoND9/k`HxCH-mp[k?~YqgZVbuz}$j7`nY`%FE0Oh+@m_nlWu[');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'twp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
