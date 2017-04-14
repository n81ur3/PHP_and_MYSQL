<?php #Script 3.5 - calculator.php

// This function creates a readio button.
// The function takes one argument: the value.
// The cuntion also makes the button "sticky".
function create_radio($value, $name='gallon_price') {
    //start the element:
    echo '<input type="radio" name="' .$name . '" value="' . $value . '"';
    //check for stickiness:
    if (isset($_POST[$name]) && ($_POST[$name] == $value)) {
        echo ' checked = "checked"';
    }
    //complete the element
    echo " /> $value ";
} //end the create_gallon_radio() function

//This function calculates the cost of the trip.
//The function takes three arguments: the distance, the fuel efficiency, and the price
//The function returns the total cost.
function calculate_trip_cost($miles, $mpm, $ppg) {
    //Get the number of gallons
    $gallons = $miles/$mpm;

    //Get the cost of those gallons
    $dollars = $gallons/$ppg;

    //Return the formatted cost:
    return number_format($dollars, 2);
} //End of calulate_trip_cost() function

$page_title = 'Trip Cost Calculator';
include ('includes/header.html');

//Check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Minimal form validation
    if (isset($_POST['distance'], $_POST['gallon_price'], $_POST['efficiency']) &&
        is_numeric($_POST['distance']) && is_numeric($_POST['gallon_price']) &&
            is_numeric($_POST['efficiency'])) {

        //Calculate results:
        $costs = calculate_trip_cost($_POST['distance'], $_POST['efficiency'], $_POST['gallon_price']);
        $hours = $_POST['distance'] / 65;

        //Print the results:
        echo '<h1>Total Estimated Cost</h1>
		<p>The total cost of driving ' . $_POST['distance'] . ' miles, averaging ' . $_POST['efficiency'] .
            ' miles per gallon, and paying an average of $' . $_POST['gallon_price'] . '
		 per gallon, is $' . $costs . ', If you drive at an average of 65 miles 
		 per hour, the trip will take approximately ' . number_format($hours, 2) . ' hours.</p>';
    } else { //Invalid submitted values.
        echo '<h1>Error!</h1>
		<p class="error">Please enter a valid distance, price per gallon, and fuel efficiency.</p>';
    }  //End of main submission IF.
}
	//Leave the PHP section anc create the HTML form:
?>
<h1>Trip Cost Calculator</h1>
<form action="calculator.php" method="post">
	<p>
        Distance (in miles): <input type="text" name="distance"
        value="<?php
                    if(isset($_POST['distance'])) {
                        echo $_POST['distance'];
                    } ?>" />
    </p>
	<p>Ave. Price Per Gallon: <span class="input">
    <?php
    $price_values = array('3.00', '3.50', '4.00');
    for ($i = 0; $i < count($price_values); $i++) {
        create_radio($price_values[$i]);
    }
    ?>
	<p>Fuel Efficiency: <select name="efficiency">
		<option value="10"<?php if(isset($_POST['efficiency']) && ($_POST['efficiency'] == '10'))
		    echo ' selected="selected"'; ?>>Terrible</option>
        <option value="20"<?php if(isset($_POST['efficiency']) && ($_POST['efficiency'] == '20'))
            echo ' selected="selected"'; ?>>Decent</option>
        <option value="30"<?php if(isset($_POST['efficiency']) && ($_POST['efficiency'] == '30'))
            echo ' selected="selected"'; ?>>Very Good</option>
        <option value="50"<?php if(isset($_POST['efficiency']) && ($_POST['efficiency'] == '50'))
            echo ' selected="selected"'; ?>>Outstanding</option>
	</select></p>
	<p><input type="submit" name="submit" value="Calculate!" /></p>
</form>

<?php include('includes/footer.html'); ?>