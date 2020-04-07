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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'demo' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '{}mpX)c`0t OyP(Lp[,wei6B~zSN.f]_uBB?/`A-<WNt>s6P*j4|g6|La(HPU-V-' );
define( 'SECURE_AUTH_KEY',  ';g9_4H#T3RUn6))Y(:Fz6O>Pu<KnNhu`Rmx3k_OJ-h!($xZX0%D2lDHeR)drC3@7' );
define( 'LOGGED_IN_KEY',    '#)d<7aSi/#76fIj0XO/rSEY}ws)iF`YPfi:1axNq-n`AsU7v+}vA`7U?!A=,~=&h' );
define( 'NONCE_KEY',        'Jv=,F(!UEjl/N/2bcj!yxw7O&n8oOY~I{e`EE{yF9(?KU5`lva6im;>]3EnjmG<O' );
define( 'AUTH_SALT',        '*g$JUPMluRTok} nt!^(12_7akg:1geGJ$&5*InyN# v0=)w,-E4)k4..AzwJ~@A' );
define( 'SECURE_AUTH_SALT', '3y/T} H#t843*3$/eZ]v?oI%*$S^:@dbYn=*lrN$6Dq!t)]=TZ F32e 9,]x5a@:' );
define( 'LOGGED_IN_SALT',   'N&u~S,c{p.0Q0e:!SWj9{EWNH0C,}&W;uPnll|:Loc69c=,^Q Ctb vE:~0EoHsc' );
define( 'NONCE_SALT',       'uoQV0EK}PCqKt17pS1_%!-wSQTSkgZ^6HtNce{gBJWUb9_4?qPqKgN*yW]&>w,/o' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'twp_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
