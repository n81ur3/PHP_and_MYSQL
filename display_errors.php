<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Basic PHP Page</title>
</head>
<body>
    <h2>Testing Display Errors</h2>
<?php # Script 8.1 - display_errors.php

//Show errors
ini_set('display_errors', 1);

//Adjust error reporting:
error_reporting(E_ALL | E_STRICT);

//Create errors:
foreach($var as $v) {}
//suppres errors with @ symbol
@$result = 1/0;

if (true) {
    trigger_error('Just a test for triggering an error and display it', E_USER_ERROR);
}

?>
</body>
</html>