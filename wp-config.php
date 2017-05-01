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
/*define('WP_HOME', 'http://mysite.com/blog');
define('WP_SITEURL', 'http://mysite.com/blog');*/

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'd132515_honzik');

/** MySQL database username */
define('DB_USER', 'a132515_honzik');

/** MySQL database password */
define('DB_PASSWORD', 'Nvhgvrft');

/** MySQL hostname */
define('DB_HOST', 'wm117.wedos.net');

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
define('AUTH_KEY',         '11oL ~d0R$L=HPU=lQWV$&}r/%e[q+c]$0Z1Lg,lwD5M#W]fBa%XY.xciM5Cag[T');
define('SECURE_AUTH_KEY',  ',t]<wYtiG_:I%M^elx],vo&E+=Oj<6!Ig>RP<7!/L-QuDO5Y`+bS`w>>~zQT/n#j');
define('LOGGED_IN_KEY',    'MhkN+,{Mn):#Q;zer.@T}|&)J}+>-lq,`bKq<Cnt7&IKa$3vlCAfd+h)t)mA6a;<');
define('NONCE_KEY',        'E4^4VX=2N/I$@MBn8o -n5&(H=+WOe4+SI8GzJFshj)~vB(kWN{(MmWKM0r~Z]Eb');
define('AUTH_SALT',        '6^6X5,vxoV?XCsUxqBkKWisS-aT//*O+JI]3H=q4!(ZSnoVQg$|Jx|v^ID4#&@5H');
define('SECURE_AUTH_SALT', 'ZZeE9%IXlBFvpQdnQSAx[d#G |FUJ&YPAchhEoyTBBfIkG7yba(RN/l2q!+C-NU<');
define('LOGGED_IN_SALT',   '&_FDXv@Zm||w.pemKUM6vBl8d4suq(RV?Jz|`J%[:Q*E~tk*v2NpQWXU9Of+l.F&');
define('NONCE_SALT',       'P66m:3BEZ27Yn!xK>j)Fk9h!E0egZ;p:`OVCb#sGB)<y^vRU@[|$XM)BEwJf]K:7');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
