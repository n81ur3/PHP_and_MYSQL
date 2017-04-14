<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Basic PHP Page</title>
</head>
<body>
    <h2>Testing Display Errors</h2>
<?php # Script 8.1 - display_errors.php

//Flag variable for site status:
define('LIVE', FALSE);

//Create the error handler
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars) {
    //Build the error message:
    $message = "An error occured in script '$e_file' on line $e_line: $e_message\n";

    //Append $e_vars to $message:
    $message .= print_r ($e_vars, 1);

    if (!LIVE){ //Development (print errors)
        echo '<pre>' . $message . "\n";
        debug_print_backtrace();
        echo '</pre><br />';
        error_log($message, 3, "/tmp/error_log.log");
    } else { //Don't show the error
        echo '<div class="error">A system error occured. We apologize for the inconvinience.</div><br />';
    }
} //End of my_error_handler() definition

//Use my_error_handler:
set_error_handler('my_error_handler');

//Create errors:
foreach($var as $v) {}
$result = 1/0;

?>
</body>
</html>