<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define('DB_NAME', 'alpha');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'c_cJ?.)4,3aq6$_ [KF!z>hhl,Ni-&h`8KMPd>c40>LU5}(y%.lyY!k!^ QM=aCn');
define('SECURE_AUTH_KEY',  '0u3h}FMfQg?Rc!kJ!0.2BBH)w1C=na$61`W{s .89UMRVNvefD+N^Z!qkVAdh9Gk');
define('LOGGED_IN_KEY',    'p^Ii{Z)7BUVjS 04[vzzY,R|bpyv[/VG;T!#xMNZc7|MFFkX |*mJpeQl1TvjT0 ');
define('NONCE_KEY',        'r6WdH{Sijuxl!^VAg~h4K/l$Cll9?=sFOEe})>%)S<cLQ~X*0UePH2:bVWZZin0%');
define('AUTH_SALT',        'qb/KI*A uRnWgxE|[xTeMi]U~[k]S,X-#:pkpK=8s7iSz~`|~NeLFTwCLtfIY)R(');
define('SECURE_AUTH_SALT', '>C>X%1S8,yt1*qz_/n.TRC=lIg~@Q^{c5j>QjJDKM1xO7!K|W*^3$GAbmwN(P[1d');
define('LOGGED_IN_SALT',   ')fW/E)*5.B!OHWeJ;$h!NFYZqip[kCy:jbhyOH1UAAM>S:DBnG|(&eUA]$oA0-LM');
define('NONCE_SALT',       '<%97g$Hd7_9+#!34zR G#`(hf($[uDq&!8MffV7*<|{K+duCIXX]6XF. _$@Rq62');

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

// disallow edit in theme and plugin
define( 'DISALLOW_FILE_EDIT', true );


