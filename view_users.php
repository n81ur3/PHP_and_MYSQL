<?php
/**
 * Created by PhpStorm.
 * User: n81ur3
 * Date: 4/12/17
 * Time: 6:14 AM
 * This script retrieves all the records from the users table
 */

$page_title = 'View the Current Users';
include('includes/header.html');

//Page header:
echo '<h1>Registered Useres</h1>';

require('mysqli_connect.php');  //Connect to the db.

//Make the query
$q = "SELECT CONCAT(last_name, ', ' , first_name) AS name, DATE_FORMAT(registration_date, '%M %d, %Y')
 AS dr FROM users ORDER BY registration_date ASC";

$r = @mysqli_query($dbc, $q); //Run the query.

//Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { //If it ran OK, display the records.
    //Print how many users there are:
    echo "<p>There are currently $num registered users.</p>";

   //Table header.
    echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
    <tr><td align="left"><b>Name</b></td><td aligne="left"><b>Date Registered</b></td></tr>';

    //Fetch and print all the records:
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '<tr><td align="left">' . $row['name'] . '</td><td align="left">' . $row['dr'] . '</td></tr>';
    }


    echo '</table>'; //Close the table.

    mysqli_free_result($r); //Free up the resources.
} else {  //If if did not ran OK
   //Public message:
    echo '<p class="error">There are currently no registered users.</p>';

    //Debugging message:
    echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
} //End of if ($r) IF.

mysqli_close($dbc);  //Close the database connection.

include('includes/footer.html');
?>
