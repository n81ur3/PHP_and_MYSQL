<?php
/**
 * Created by PhpStorm.
 * User: n81ur3
 * Date: 4/19/17
 * Time: 9:33 PM
 * This page prints any erros associated with logging in
 * and it creates the entire login page, including the form.
 */

//Include the header
$page_title = "Login";
include("includes/header.html");

//Print any error message, if they exist
if (isset($errors) && !empty($errors)) {
    echo '<p class="error">The following error(s) occured:<br />';
    foreach($errors as $msg) {
        echo " - $msg<br />\n";
    }
    echo '</p><p>Please try again.</p>';
}

//Display the form
?>
<h1>Login</h1>
<form action="login.php" method="post">
    <p>Email Address:<input type="text" name="email" size="20" maxlength="60" /></p>
    <p>Password: <input type="password" name="pass" size="20" maxlength="20" /></p>
    <p><input type="submit" name="submit" value="Login" /></p>
</form>

<?php include("includes/footer.html");
