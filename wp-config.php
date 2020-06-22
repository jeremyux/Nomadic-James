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

define( 'DB_NAME', "theme" );


/** MySQL database username */

define( 'DB_USER', "admin" );


/** MySQL database password */

define( 'DB_PASSWORD', "big4tune" );


/** MySQL hostname */

define( 'DB_HOST', "localhost" );


/** Database Charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8mb4' );


/** The Database Collate type. Don't change this if in doubt. */

define( 'DB_COLLATE', '' );

define( 'FS_METHOD', 'direct' );
/**#@+

 * Authentication Unique Keys and Salts.

 *

 * Change these to different unique phrases!

 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}

 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define( 'AUTH_KEY',         'Hy<]|XHcfv&sQ);kT}o,uM#>JHhg,W!bmE5ojw=fdWSX}hUN-m Fr2%~8L`FK;.[' );

define( 'SECURE_AUTH_KEY',  'E&Zn]M>~x?CzF< PkunPwcaO? ~I5Yi)k>Gq@[bS(d&Ec:Vzx@bI;Zm1wlc3<o1%' );

define( 'LOGGED_IN_KEY',    '#tD0Ell]d(1JAK)[:MDiYi00l3g7|S%NPOvKHYX#>b :@!scQS7CFO`a#LUAZ^UG' );

define( 'NONCE_KEY',        ',xCGG@/AQ#s$n^:vHgZobM]qOQ+Xp-1_cgm2%}%b&@Uf@c;E|?DVarmImr)2JAdA' );

define( 'AUTH_SALT',        '4z%% VuYz8`r[`:5bn#Q7&729q15Gh3#lX@Feo2(N$6CotARNi[Y/~PBFM,8$tG}' );

define( 'SECURE_AUTH_SALT', '2_Kq[^M?3ux%Vd-tT4U}c4XR&07z},6w@}Tl`3-7FGcsW/ Xr4dss`g o}ul{p=7' );

define( 'LOGGED_IN_SALT',   'map4d$XXn:!N=/^$S=?`]UM_(.w{w@?TWuzi$Af8xw%&G/O^NH}FFw[AVGe{?2x6' );

define( 'NONCE_SALT',       'bhDo-~U%56Y-)(C}O.MC!uMvGi96X%OQhQ|a@h3a(iW32!-uFr*#8Q3T;Z<l0n9[' );


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

define( 'WP_DEBUG', false );


/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

}


/** Sets up WordPress vars and included files. */

require_once( ABSPATH . 'wp-settings.php' );



