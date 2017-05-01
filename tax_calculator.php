<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Widget Cost Calculator</title>
</head>
<body>
<?php # Script 13.2 - tax_calculator.php
//This script calculates an order total based upon three form values.

//Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Cast all the variables to a specific type(for security)
    $quantity = (int) $_POST['quantity'];
    $price = (float) $_POST['price'];
    $tax = (float) $_POST['tax'];

    //Sanitize the variables
    $quantity = (isset($_POST['quantity'])) ? filter_var($_POST['quantity'], FILTER_VALIDATE_INT, array('min_range' => 1)) : NULL;
    $price = (isset($_POST['price'])) ? filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : NULL;
    $tax = (isset($_POST['tax'])) ? filter_var($_POST['tax'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : NULL;
    //All variables should be positive
    if (($quantity > 0) && ($price > 0) && ($tax > 0)) {
        //Calculate the total
        $total = $quantity * $price;
        $total = $total * ($tax / 100);

        //Print the resutl
        echo '<p>The total cost of purchasing ' . $quantity . ' widget(s) at $' . number_format($price, 2) . ' each, 
            plus tax, is $' . number_format($total, 2) . '</p>';
    } else { //Invalid submitted values
        echo '<p style="font weight: bold; color: #C00">Please enter a valid quantity, price and tax rate </p>';
    }
}

//Leave the PHP section and create the HTML form
?>
<h2>Widget Cost Calculator</h2>
<form action="tax_calculator.php" method="post">
    <p>Quantity: <input type="text" name="quantity" size="5" maxlength="10"
        value="<?php if (isset($_POST['quantity'])) echo $quantity; ?>" /></p>
    <p>Price: <input type="text" name="price" size="5" maxlength="10"
        value="<?php if (isset($_POST['price'])) echo $price; ?>" /></p>
    <p>Tax(%): <input type="text" name="tax" size="5" maxlength="10"
        value="<?php if (isset($_POST['tax'])) echo $tax; ?>" /></p>
    <p><input type="submit" name="submit" value="Calculate"/></p>
</form>
</body>
</html>