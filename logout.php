<?php
// we have to call start in order to call destroy.  Dumb but true.
session_start();

// remove current session
session_destroy();

// redirect to login
header('location:login.php');

?>