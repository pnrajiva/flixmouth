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
/**
* Enable Session
*/
	session_start();
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'clownfish');

/** MySQL hostname */
define('DB_HOST', 'int-mysql.flixmouth.com');

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
define('AUTH_KEY',         '6^7oGUFPRi-DvvMw/L!=<Om6VahWjz$8c?-1@{G3l%sd|~t[w_QFQ+U6i;oV,KEo');
define('SECURE_AUTH_KEY',  'qeadoy6Eo6;!r)]_-ugXH:L3J*OQc(Z}Q=*gcJBHe(1>1#:Kikz+k~%k^Jtw-Yct');
define('LOGGED_IN_KEY',    '1yEl!4%aU,KG{H+(m18}JDo#5o2!_J;m?|bdsB?hI!|d4ukTUKyP4F;)IeN2lh_!');
define('NONCE_KEY',        'U8pCGG-vVQg&A1A[2+G,WdVu-|;60Q>8ral]zxbUY:tN::g67yH*&IJ6OxN4h[?n');
define('AUTH_SALT',        '|cfBH8U`{1}p-L!$f&.^qmN1-D5)p<=x!lhXq|#gIxH7`Td gIiFCOl}PS?@vw0>');
define('SECURE_AUTH_SALT', ' wgKk?&BH)/`vN9$/}:&G*lq$6x0vXY[|d^s OS}+*1X;9&M4>._7KCgk_>s-0J{');
define('LOGGED_IN_SALT',   'H%pya17$ai@HjlJtH^DbIn;P_-qawHA!|CMY^ (Mvph=-C)guF5Ecd^}h0::|H+9');
define('NONCE_SALT',       'dwX.iR0z`(qJyCziz4MPj?2g&_2*tAu=#-D<7P~NSJR#~KMeJ<y5rIjZ]^D+v4`E');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
