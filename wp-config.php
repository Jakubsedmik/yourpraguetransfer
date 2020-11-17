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
define( 'DB_NAME', 'yourpraguetransfer' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/** Přívlastek k URL, na produkci je třeba měnit */
define( "BASE_URL", "/yourpraguetransfer/" );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'x.~$|<P/~0iEW4yQ=1@C]i&)-SlE@Apb*yq(5N;zbI3D:QGZNk_8>j.J1maKepEn' );
define( 'SECURE_AUTH_KEY',  'Ix5,$NxQ*/FzP` E{)XN1*5!`xSXzD:MV-*tMi-ly~$~P| WN1IrEG>]P}NJMV[@' );
define( 'LOGGED_IN_KEY',    'dz@VLFB?FO+J;PF-ya(tz~^Q~j*lwO(W;ow}]8+~ft2k>nWJ`:/{V!.IfLbmJ09q' );
define( 'NONCE_KEY',        'q4lwU[lwPjZS|EbX@V9hr9,b4F}8*Wqg/a-M`gidc17^HKl[zX(~DB~vRVEK9Uny' );
define( 'AUTH_SALT',        'o.PUv]753:Q.NDD5qpiD(q:xdN>e$XW|/[_x4.]FR,/&*c44pqCf(R,$q Q MqC$' );
define( 'SECURE_AUTH_SALT', 'F6/z&i%RrK6#bTt*V]{8Y-j!:?zh6I&lh5L*zb%k,@a<mS;)m#R}&Zv)2sbu*sjC' );
define( 'LOGGED_IN_SALT',   'OqpOTnNf(Yi#m!C; sm@IV0+YBpRra$ELN7FFVm}:F=(5-RoY[Z_:a:wvFi9E`l}' );
define( 'NONCE_SALT',       'TZ.G*is4k}KE|6sLOC.`{@}V?@TP6PqShl,}w0=RGFsKO5@?5WB!8zHFi_eFO)IL' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', true );



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
