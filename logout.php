<?php
/**
 * Created by PhpStorm.
 * User: n81ur3
 * Date: 4/21/17
 * Time: 10:39 PM
 * This page lets the user logout.
 */

session_start();

//If no cookie is presetn, redirect the user
if (!isset($_SESSION['user_id'])) {
    //Need the function
    require('includes/login_function.inc.php');
    redirect_user();
} else { //Cancel the session
    $_SESSION = array();    //Clear the variables
    session_destroy();      //Destroy the session itself
    setcookie('PHPSESSID', '', time() - 3600, '/', '', 0, 0);  //Destroy the session cookie
}

//Set the page title and include the HTML header
$page_title = "Logged Out!";
include('includes/header.html');

//Print custominzed message
echo "<h1>Logged Out!</h1>
<p>You are now logged out</p>";

include('includes/footer.html');
?>