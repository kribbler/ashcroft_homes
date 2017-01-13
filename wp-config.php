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
define('DB_NAME', '');

/** MySQL database username */
define('DB_USER', '');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         ';Umve=n||-~7&7|:mlw-^%RybjW%c4*]}u*w%*Sf*NbGYIfmi3WW(H)xW]})/_8-');
define('SECURE_AUTH_KEY',  '9&Cyw#l+2)>4ztBPN2!+P%6&F|~>G#8O?lw+.p HD/Ql9Z}8CU~+`uUtxrKg}lwV');
define('LOGGED_IN_KEY',    '? 5bW4y/q1@JhL/l%O:b)vGv|)=q8?Y<;A_)dl:dzlC9NQ_>Z@fA H0HjXlqp0B.');
define('NONCE_KEY',        'gB}ghH?Q3?|~u.{wLe)LJ$C%5vA:((DX1Bm|!/vgyr=(OAR?@#*PYM8axa{~,-(X');
define('AUTH_SALT',        'xBCS+Jf>U-c }W[9,(#[q+Zd~H~6,3zsE*`u|R|[tOWG3p&Wqiegi^Om)o;mh%Jl');
define('SECURE_AUTH_SALT', '~-g(+?bPpOi:5++?FD0RRP:mO*XPY#kq3Q7pnOxlmS4[][hN9Jy}^K9Av-.}=.*S');
define('LOGGED_IN_SALT',   '>x6sH]Sr*?L`A]MjDcyW:>4Y+?EmaR{!J-M-EY( d({4[sifAD7 6k<Tb2,cYMkV');
define('NONCE_SALT',       'E!*}XX#9^[uOTvU|)z%HU:hydiFd2tufn:Js3X>nj`W|FeuPNIG$1]rmg/-4z|wy');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
