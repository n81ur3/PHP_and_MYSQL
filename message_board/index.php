<?php
/**
 * Created by: bierbaumer
 * Date: 9/24/17
 * Time: 6:49 AM
 * This is the main page for the site.
 */

// Include the HTML header:
include('includes/header.html');

// The content on this page is introductory text pulled from the database
// based upon the selected language:
echo $words['intro'];

// Include the HTML footer file:
include('includes/footer.html');
?>