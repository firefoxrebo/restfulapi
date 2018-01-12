<?php

/*
 * The application path which will be used to define the main application path in the system
 */
defined('APP_PATH') ? null          : define('APP_PATH', realpath(dirname(__FILE__)) . DS . '..' . DS);


/*
 * Database Credentials
 */

defined('DATABASE_HOST_NAME')       ? null : define ('DATABASE_HOST_NAME', 'localhost');
defined('DATABASE_USER_NAME')       ? null : define ('DATABASE_USER_NAME', 'root');
defined('DATABASE_PASSWORD')        ? null : define ('DATABASE_PASSWORD', 'rebo');
defined('DATABASE_DB_NAME')         ? null : define ('DATABASE_DB_NAME', 'restapi');
defined('DATABASE_PORT_NUMBER')     ? null : define ('DATABASE_PORT_NUMBER', 3306);
defined('DATABASE_CONN_DRIVER')     ? null : define ('DATABASE_CONN_DRIVER', 1);

/**
 * Temporary API Credentials
 */

defined('API_AUTHORIZATION_KEY')     ? null : define ('API_AUTHORIZATION_KEY', 'AAAAV-VAFJg:APA91bGcvvfbXFMuDvP-QxafH35cFt5AvZzXTh1AVflW84T48_U_07NAMZ0HqtMlPbcIoLL4DnycWKNbh_t2CWAerPdRLYBJz_up9CejHBuid3elQ7enPh_F274K8ROirchIh8031r_');