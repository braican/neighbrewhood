<?php
require_once("libraries/password_compatibility_library.php");

// include the configs / constants for the database connection
require_once("db_util.php");

// load the registration class
require_once("classes/Registration.php");

// create the registration object. when this object is created, it will do all registration stuff automaticly
// so this single line handles the entire registration process.
$registration = new Registration();

// show negative messages
if ($registration->errors) {
    foreach ($registration->errors as $error) {
        echo $error;    
    }
}
    
// show positive messages
if ($registration->messages) {
    foreach ($registration->messages as $message) {
        echo $message;
    }
}

?>


<!-- backlink -->
<a href="index.php">Back to Login Page</a>