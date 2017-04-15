<?php
/**
 * Created by PhpStorm.
 * User: n81ur3
 * Date: 4/15/17
 * Time: 6:23 AM
 * This page is for deleting a user recodr. This page is accessed through view_users.php
 */

$page_title ='Delete a User';
include ('includes/header.html');
echo '<h1>Delete a User</h1>';

//Check for a valid user ID, through GET
if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
    $id = $_GET['id'];
} elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
    $id = $_POST['id'];
} else {
    echo '<p class="error">This page has been accessed in error.</p>';
    include('includes/footer.html');
}

require_once('mysqli_connect.php');

//Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['sure'] == 'Yes') {
        //Delete the record.

        //Make the query
        $q = "DELETE FROM users WHERE user_id = $id LIMIT 1";
        $r = @mysqli_query($dbc, $q);
        if (mysqli_affected_rows($dbc) == 1) { //If it ran OK
            //Print a message
            echo '<p>The user has been deleted</p>';
        } else {
            echo '<p class="error">The user could not be deleted due to a system error</p>';

            //Debugging message
            echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>';
        }
    } else {
        echo '<p>The user has NOT been deleted.</p>';
    }
} else {
    $q = "SELECT CONCAT(last_name, ', ', first_name) FROM users WHERE user_id=$id";
    $r = @mysqli_query($dbc, $q);

    if (mysqli_num_rows($r) == 1) {
        //Get the user's information:
        $row = mysqli_fetch_array($r, MYSQLI_NUM);

        //Display the record being deleted:
        echo "<h3>Name: $row[0]</h3>
        Are you sure you want to delete this user?";

        //Create the form:
        echo '<form action="delete_user.php" method="post">
            <input type="radio" name="sure" value="Yes" /> Yes
            <input type="radio" name="sure" value="No" /> No
            <input type="submit" name="submit" value="Submit" />
            <input type="hidden" name="id" value="' . $id . '" />
        </form>';
    } else {
        echo '<p class="error">This page has been accessed in error.</p>';
    }
} //End of main submission

mysqli_close($dbc);

include('includes/footer.html');
?>
