<?php
/**
 * Created by PhpStorm.
 * User: n81ur3
 * Date: 4/22/17
 * Time: 6:21 AM
 * The user is redirected here from login.php
 */

session_start();

//If no cookie is present, redirect the user
if ((!isset($_SESSION['user_id'])) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']))) {
    //Need the function
    require('includes/login_function.inc.php');
    redirect_user();
}

//Set the page title and include the HTML header
$page_title = 'Logged In!';
include ('includes/header.html');

//Print a customized message
echo "<h1>Logged In</h1>
<p>You are now logged in {$_SESSION['first_name']}</p>;
<p><a href=\"logout.php\">Logout</a></p>";

include('includes/footer.html');
?>