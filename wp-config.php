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
define( 'DB_NAME', 'portfolio_wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '123456' );

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
define( 'AUTH_KEY',         '(_= 96db )_{_W|.sMY`SY%9|[$c??46(;/Mq@h+x)LlS!Nv>.3,FkZ F7-g&,)|' );
define( 'SECURE_AUTH_KEY',  '*@N1/xww,=CQ*}$%h|#`znjeR=.hTrZ!rs.qMV3mIfYcz8%Obl3 z{!lw2Sq8|@S' );
define( 'LOGGED_IN_KEY',    'ro~ld[(A&!elUUBg9Z}2~w)PuDo|Gri7+{O_U-?6Gx}a+Q+9vl 2*1m^lNX~jjQ9' );
define( 'NONCE_KEY',        'frpn@r{pN>1Zs3JXmXI|$}^F?]@nIE+T=~9 +]lqjU}Q$<qn/?]{)$aWRGR4TKY ' );
define( 'AUTH_SALT',        'v&A/OmCP.Em~=7>3,z,V;t<3:7`^&uITtlVQ76&<EXzb{<p`(YK[Q@0zDOY[e[mv' );
define( 'SECURE_AUTH_SALT', 'E!W M+SqW(~Z@jGKm&(67bzX0K%Hh8zXoSGz!,Fu-uCb3!{$VpoVmI7fKq_S,+kk' );
define( 'LOGGED_IN_SALT',   'h{YU<T2OR8T1sv)o5qDba|Bp9)tu^4l!@SU YWG<fUN)6sO +R]gF+W9B</7* z|' );
define( 'NONCE_SALT',       't~}_l8U<JF]|*HSyO<J0cD/}WC.y0s>}e*~ T(|g)D4sKucjnmPuY6:gm~M{p<cW' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

define('FS_METHOD', 'direct');

define('WP_HOME','http://webetechies.com/'); 
define('WP_SITEURL','http://webetechies.com/');



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
