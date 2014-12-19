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
define('DB_NAME', 'sergio');

/** MySQL database username */
define('DB_USER', 'wits');

/** MySQL database password */
define('DB_PASSWORD', 'developer1234');

/** MySQL hostname */
define('DB_HOST', '192.168.1.2');

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
define('AUTH_KEY',         '^y%XKxG2RoV}`_|)e{# !Ptd1#%RuvfS|^+[<+)<6l(MYXhKff5akvaY2zsFWrkN');
define('SECURE_AUTH_KEY',  'r%w}E2r#xaco_F0WrTo8WP!Jd4:#L1bp( L/EBXW}VW&aPys|;-V;L;D2v_1y|Xh');
define('LOGGED_IN_KEY',    '+n<IKV};|jhA>!B4Y06R<H{d%UF27b4@3+Lc4|B_8bN1vg!cUhq}e%.E1/_yKw!-');
define('NONCE_KEY',        'o0K$*48}t8=}Sf3Y@Jc&q?b|J(D5VJP4ZdiWM,zG/U:%]OQIOtHRFoo~$Wi7wy{^');
define('AUTH_SALT',        'Op=m:,l/6C=]Z<iY;y9A$vjOxn?|P]@-c<qI-A[Xh=1LW?auCfp_Df^NH[MD%T}v');
define('SECURE_AUTH_SALT', '65Ra5Gq~xp9i|?|2@%WsVI7a%t626yHH21d=$%d*mj-#D>E%j&-~9D>[^p$b+gB1');
define('LOGGED_IN_SALT',   'o=kl}OBqJSFtyOzN-=U?Nx4C!2Cg-WO[4fWY+<xr9RCZmMsCNs{h-|-nk?4<S3E;');
define('NONCE_SALT',       '3In+BWXz_zK$ 4&`-.t-}[i^-P`;4V}{7d7|No><*2f4Xl~E2//)-gJ|-4~G<+,1');

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
