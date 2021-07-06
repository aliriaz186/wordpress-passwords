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
define( 'DB_NAME', 'wordpress_passwords' );

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

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '.t ]sFi|d4&2BKm<q9}Rk7zO&5-&b}3(m}d(15.YG119cas5dQ1&ljqoho;@w|a@' );
define( 'SECURE_AUTH_KEY',  'zxTi5ArOJ/$db,nt^ lsgUQZo}CR8 J!R2bo,:<2y48Wj&M1^ 1JsJ`c[1tfb{t<' );
define( 'LOGGED_IN_KEY',    'R&[<]!2FlwAAW!*_M|=C,uc@iI$kgF3?fQO5U-ssa12Z<v&W;~7 |eAeJMG& ]<;' );
define( 'NONCE_KEY',        'VY%WcnwHAHbvFovx3y24!(G#}pO5}N@|1$5O9#%AwS}# QVK5i0oi%5JKg-a>n{;' );
define( 'AUTH_SALT',        'dYq/,QB9:9zE-R=EAuOytnq]6HhnWcGF+zR-+m#Lq4elH2ERdiVv!Taj]zt@P1nH' );
define( 'SECURE_AUTH_SALT', ':7G97B]BDqhG : ~,B@2:uv86^iCk6gxA/2atyCc{wb0&Pjo)if[+EAOxqVEU}7]' );
define( 'LOGGED_IN_SALT',   '(|tHSMK8E0RzT?+ZPd|gz%6ixrjg?%  StC =qumI=%!h%[F/-8DD}K6d)cAR11J' );
define( 'NONCE_SALT',       '|*8O[> l/S4iQ>la:{Z.6U4b.j#f_|(? @tbOyIV=9/<4KPU8(C2ka3A576Ltd=(' );

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
