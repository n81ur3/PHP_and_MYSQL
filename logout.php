<?php
/**
 * Created by PhpStorm.
 * User: n81ur3
 * Date: 4/21/17
 * Time: 10:39 PM
 * This page lets the user logout.
 */

//If no cookie is presetn, redirect the user
if (!isset($_COOKIE['user_id'])) {
    //Need the function
    require('includes/login_function.inc.php');
    redirect_user();
} else {
    setcookie('user_id', '', time() - 3600, '/', '', 0, 0);
    setcookie('first_name', '', time() - 3600, '/', '', 0, 0);
}

//Set the page title and include the HTML header
$page_title = "Logged Out!";
include('includes/header.html');

//Print custominzed message
echo "<h1>Logged Out!</h1>
<p>You are now logged out, {$_COOKIE['first_name']}</p>";

include('includes/footer.html');
?>