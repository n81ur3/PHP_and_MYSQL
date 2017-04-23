<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Upload a RTF Document</title>
</head>
<body>
<?php # Script 13.3 - upload_rtf.php
//Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && file_exists($_FILES['upload']['tmp_name'])) {
   //Check for an uploaded file
    if (isset($_FILES['upload'])) {

        //Validate the type
        //Create the resource
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);

        //Check the file
        if (finfo_file($fileinfo, $_FILES['upload']['tmp_name']) == 'text/rtf') {
            //Indicate it's okay
            $ok_message = <<<EOF
<p><em>The file would be accepted</em></p>
EOF;
            echo $ok_message;

            //In theory, move the file over
            //Since it's just a test, we are deleting the file
            unlink($_FILES['upload']['tmp_name']);
        } else {
            //Invalid type
            $invalid_message = <<<EOF
<p style="font-weight: bold; color: #C00">
Please upload an RTF document only.
</p>
EOF;
            echo $invalid_message;

            //Close the resource
            finfo_close($fileinfo);
        }
    }
}
?>
<form enctype="multipart/form-data" action="upload_rtf.php" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="524288" />
    <fieldset>
        <legend>Select an RTF document of 512KB or smaller to be uploaded:</legend>
        <p><b>File</b> <input type="file" name="upload" /></p>
    </fieldset>
    <div align="center">
        <input type="submit" name="submit" value="Submit" />
    </div>
</form>
</body>
</html>