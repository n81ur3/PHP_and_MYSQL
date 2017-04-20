<?php
/**
 * Created by PhpStorm.
 * User: n81ur3
 * Date: 4/20/17
 * Time: 6:40 PM
 * This page processes the login form submission.
 * Upon successful login, the user is redirected.
 * Two included files are necessary.
 * Send NOTHING to the Web browser prior to the setcookie() lines!
 */

//Check if the form was been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //For processing the login
    require('includes/login_function.inc.php');

    //Need the database connection
    require('mysqli_connect.php');

    //Check the login
    list($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);

    if ($check) {
        //Set the cookies
        setcookie('user_id', $data['user_id']);
        setcookie('first_name', $data['first_name']);

        //Redirect
        redirect_user('loggedin.php');
    } else {
        //Assign $data to $errors for error reporting in the login_page.inc.php file
        $error = $data;
    }

    mysqli_close($dbc);
}
    //Create the page
    include('includes/login_page.inc.php');
?>

