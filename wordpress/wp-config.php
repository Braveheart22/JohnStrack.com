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
define('DB_NAME', 'wrd_727ahii7n3');

/** MySQL database username */
define('DB_USER', 'wrdrrp8i12O');

/** MySQL database password */
define('DB_PASSWORD', '5o5GOYXZRA');

/** MySQL hostname */
define('DB_HOST', 'johnstrackcom.domaincommysql.com');

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
define('AUTH_KEY',         'XIgv3pYPiRHrPQD0NYlww3TfwRglz6xWZOg4urt6faw4mrLemArgjT5fgAksonTq');
define('SECURE_AUTH_KEY',  'r9vOXoBLlHVy498r6uKEsRj3uTsqQU5u5halPVmvMcpFt9FaUH9uj703EmTq8kW8');
define('LOGGED_IN_KEY',    'uXa6LvVYxuhRQ3HswwTVRmFTIzaxDhhsMJCpOmupDllEGFUPpTuMc4lHaUYDH8uE');
define('NONCE_KEY',        'FbR8IAJG9fwk16ByZoK2NK16HqiTcPBgf2Z1pgBOxNxuDCRFlBUnGd0XfjVJ0bTu');
define('AUTH_SALT',        '8tBlwh4hhlX5uBr6EhbssiQF7hBiz6RvuMUIWbQPEAHb18BLoH3N56X1VLDs8W1z');
define('SECURE_AUTH_SALT', '5Vn3Y45rrtnQ9yPUYuBlwLlrajpCGBZOjx8dSh5YDQBT7iwI0XANBPgOppI89aDG');
define('LOGGED_IN_SALT',   'OiTChVGbJBcwdHsbxYk7Vm6rjBuptIighUi4LUmllCbhzCkm0LorbO9BJEXGLw7u');
define('NONCE_SALT',       'XohrN3OBViA5ZRxvZXF401lLalwK2sIXTG1I5vSDchPfAAtwFv32BsCcti0SuYKP');

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
