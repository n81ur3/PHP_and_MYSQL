<?php
/**
 * Created by PhpStorm.
 * User: n81ur3
 * Date: 4/11/17
 * Time: 11:39 AM
 * This file contains the database access information.
 * This file also establishes aconnectionto MyDQL,
 * selects the database, and sets the encoding.
 */

//Set the database access information as constants:
DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'forum2');


//Make the connection:
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to 
MySQL: ' . mysqli_connect_error());

//Set the encoding
mysqli_set_charset($dbc, 'utf8');