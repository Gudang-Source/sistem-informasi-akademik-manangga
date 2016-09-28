<?php
error_reporting( 0 ); // development only, disable on live site

//** MySQL settings - You can get this info from your web host ** //
/** MySQL database name */
define( 'DB_NAME', 'db_manangga' ); // Diisi nama database

/** MySQL database username */
define( 'DB_USER', 'b728249e747ac9' ); // Diisi username MySQL

/** MySQL database password */
define( 'DB_PASSWORD', '2feb713a' ); // Diisi username MySQL

/** MySQL hostname */
define( 'DB_HOST', 'ap-cdbr-azure-southeast-b.cloudapp.net' ); // Diisi nama host apache (default: localhost)


$authcon = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysql_select_db(DB_NAME, $authcon);

if ($authcon) {
    //echo "Connection SUCCESS!";
} else {
    echo "Connection FAILED!";
}

/**
* STOP EDITING HERE !!! HAVE FUN
**/

/** System default time zone **/
date_default_timezone_set( 'Asia/Jakarta' );
ini_set( 'date.timezone', 'Asia/Jakarta' );

/** System default locale **/
setlocale( LC_ALL, 'id_ID' );
setlocale( LC_ALL, 'id-ID' );
setlocale( LC_ALL, 'IND' );
