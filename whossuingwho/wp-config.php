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
define( 'DB_NAME', 'bailynlaw_whossuingwho' );

/** MySQL database username */
define( 'DB_USER', 'bailynlaw_whossuingwho' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Whossuingwho1!+' );

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
define( 'AUTH_KEY',         'O7V88}yL?SbA/yPL-ZlM?5?6-PhC31SvsN_0A7?C@=4<OnI|*$5[C_r|8=crQ|TL' );
define( 'SECURE_AUTH_KEY',  'I[C_}7cG4nXU56W8@CQ@Gg]o(+P#jhcE2N`C%W-CzR#]&/IFcM(o8GzR#tD%SWJl' );
define( 'LOGGED_IN_KEY',    '~K*iY])/H`)M3hjyT;{v)r$6AOADVkN)iiPF`xh^kGH0 i5Csyi%ZM2/f>)R_:_b' );
define( 'NONCE_KEY',        'PRzH1B~P~v%Z;7,]ORPDbWkBYtF:$(:Jjc:p>+FnJDP?WAJW++dwH2]X_oKq.:Jk' );
define( 'AUTH_SALT',        '$)E}Kb#zU.y49-HTg3nO1|P%OouB,Sy<]JP.IwPI3/@hcE?BA?;z5pkj!xZ5uX*}' );
define( 'SECURE_AUTH_SALT', 'J?CenhbtTnV/W$^`{K!;eRu&{D};:jV]/9v<$#Ot7-/rJ19QYGHiNw^PwhpK(WLY' );
define( 'LOGGED_IN_SALT',   ':fU6GjGwjxuCo/YudFSlWgJ~KCq=CUJ~zV1~b I}D->X*OIkF[D6vp8J:6`@*k3s' );
define( 'NONCE_SALT',       '!IT=cn)0oZQ03Y8[]y#YzO VzzHOjl*>dPtghzrSa6 S;]e#kr5O!PM@Dv)bA/.+' );

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
