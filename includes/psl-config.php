<?php
//source: http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
//modified by Daniel Kasprowicz
/**
 * These are the database login details
 */
define("HOST", "localhost");     // The host you want to connect to.
define("USER", "root");    // The database username.
define("PASSWORD", "");    // The database password.
define("DATABASE", "TeamX14");    // The database name.

define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");

define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!!
?>