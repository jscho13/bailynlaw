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
define('DB_NAME', 'bailynlaw_bailynla_wordpress');

/** MySQL database username */
define('DB_USER', 'bailynlaw_wp_user');

/** MySQL database password */
define('DB_PASSWORD', 'pd94SN73(@');

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
define('AUTH_KEY',         ' Y6JEyz*e8fwB0rkZCrJmt W;03euNMv5&W8h]T9,Jt$[te-[@+/9bs=Czoi=9Lw');
define('SECURE_AUTH_KEY',  ':nX[R?#B.OWD*+#]l(uLc>{^pC)10s%>vgAdLc LuE6X+u%N_Yz0Qo5E25iMkabq');
define('LOGGED_IN_KEY',    '<y.x_GfY/3lgNP`(r^+it]5j%Ezv>8Op513HK@bYtcQnqs9Q`K^5`L=}b#=t,Cl]');
define('NONCE_KEY',        '4=+B]8;Q-rHm=Zv2^W6dTCbICEV!Gr2D:-3^Q~zh*;oSw]pz6tv5KjLZ&n3(a4^f');
define('AUTH_SALT',        'N_!6g^Hef<)9=)TnR{Ao`88m}Qbe`zL!vrj4KcaUaE_7IFHznMG[< 9~{uVoa]j6');
define('SECURE_AUTH_SALT', '%O<Ic Z~EjA?&P~&-8hkI_>}m5j!S+B,Chn%cPKN3#3H+BBl,R(Mswsy}!;%j]6P');
define('LOGGED_IN_SALT',   's*!mp]NWZIsL-UM%hX.74@lsS.hDFGUO#/[itiS@A6eM<v=x>=-4,-FKWR}:T XI');
define('NONCE_SALT',       '%y)S|7`{t-m]w{wdW]7Yf~+#?Pmy;bk$IMoJ&nCFvtm)j4y8^:YgeK;i@,#-cO;G');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
