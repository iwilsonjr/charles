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
define('AUTH_KEY',         'P0jAqRi.^PT|edxXEP4Mna~^yNVK`rI|X~C.>$0Y?Y$S1kva4p+8]6ZtNeOb||RH');
define('SECURE_AUTH_KEY',  'a=b,.Xn|&eD+!p-[^V#Y]j7M%H8qI[uc2YLS:W%vdE]fD-[/Zkk;#wpsbZ4L!i9F');
define('LOGGED_IN_KEY',    ':< A|SZ1>XdX(5_=.>Hv66{xkR||&Fe|wl^V1J+64[j`=H|p*cEYP!I?ugG,+AQ[');
define('NONCE_KEY',        'o m4%8op0gL@Ak1HiPN-/y=Cf|&AZZq#)Suge}9y:+O-+?hCe-s:*_s:kY[8S:1.');
define('AUTH_SALT',        'M:$Kk=O8rWzwdtB{WXl-GnC||Be*wuF6a+du8pc9p>+C.e872g4TViq1pooqdsF|');
define('SECURE_AUTH_SALT', '{wddO9&nDTd44}f pv*ApM3+aed{Ir@xmIbdr@m_&aQ!}c!mOlxV6SV0 <2?.dYB');
define('LOGGED_IN_SALT',   '4c-rC*..39lO|wK)%#f<3x+@+NH|8nT3}J UTI0.+/269y1&:vPY|*+_1?3m_P*<');
define('NONCE_SALT',       'RyF>#r{v6F.K(4cVb~?%:12K{)IyYQ_w8DCB)S5imt]gY8dhVlF#qh[08*hph|sB');

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
