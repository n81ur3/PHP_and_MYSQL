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

//Number of records to show per page
$display = 10;

//Determine how many pages there are
if (isset($_GET['p']) && (is_numeric($_GET['p']))) { //Already been determined
    $pages = $_GET['p'];
} else { //Need to determine
    //Count the number of records
    $q = "SELECT COUNT(user_id) FROM users";
    $r = @mysqli_query($dbc, $q);
    $row = mysqli_fetch_array($r, MYSQLI_NUM);
    $records = $row[0];

    //Calculate the number of pages
    if ($records > $display) { //More than 1 page
        $pages = ceil($records / $display);
    } else {
        $pages = 1;
    }
}

//Determine where in the database to start returning results
if (isset($_GET['s']) && (is_numeric($_GET['s']))) {
    $start = $_GET['s'];
} else {
    $start = 0;
}

//Determine the sort
//Default is by registration date
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

//Determine the sorting number
switch ($sort) {
    case 'fn':
        $order_by = 'first_name ASC';
        break;
    case 'ln':
        $order_by = 'last_name ASC';
        break;
    case 'rd':
        $order_by = 'registration_date ASC';
        break;
    default:
        $order_by = 'registration_date ASC';
        $sort = 'rd';
        break;
}

//Make the query
$q = "SELECT last_name, first_name, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr,
user_id FROM users ORDER BY $order_by LIMIT $start, $display";
$r = @mysqli_query($dbc, $q); //Run the query.

//Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { //If it ran OK, display the records.
    //Print how many users there are:
    echo "<p>There are currently $num registered users.</p>";

   //Table header.
    echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
    <tr>
        <td align="left"><b>Edit</b></td>
        <td align="left"><b>Delete</b></td>
        <td align="left"><b><a href="view_users.php?sort=ln">Last Name</a></b></td>
        <td align="left"><b><a href="view_users.php?sort=fn">First Name</a></b></td>
        <td align="left"><b><a href="view_users.php?sort=rd">Date Registered</a></b></td>
    </tr>';

    //Fetch and print all the records:
    $bg = '#eeeeee'; //Set the initial background color
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        $bg = ($bg == '#eeeeee' ? '#bbbbbb' : '#eeeeee'); //Alternate the background color
        echo '<tr bgcolor="' . $bg .'">
            <td align="left"><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></td>
            <td align="left"><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></td></td>
            <td align="left">' . $row['last_name'] . '</td>
            <td align="left">' . $row['first_name'] . '</td>
            <td align="left">' . $row['dr'] . '</td>
        </tr>';
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

//Make the links t other pages, if necessary
if ($pages > 1) {
    //Add some spacing and start a paragraph
   echo '<br /><p>';

   //Determine what page the script is
    $current_page = ($start/$display) + 1;

    //If it's not the first page, make a Previous link
    if ($current_page != 1) {
        echo '<a href="view_users.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous </a>';
    }

    //Make all the numbered pages
    for ($i = 1; $i < $pages; $i++) {
        if ($i != $current_page) {
            echo '<a href="view_users.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
        } else {
            echo $i . ' ';
        }
    }

    //If it's not the last page, make a Next button
    if ($current_page != $pages) {
        echo '<a href="view_users.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
    }

    //Close the paragraph
    echo '</p>';
}

include('includes/footer.html');
?>
