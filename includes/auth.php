<?php
// call session_start first in order to try to read any session var
session_start();

// check the session for a username var.  if exists => authenticated.  if not => anonymous
if (empty($_SESSION['username'])) {
    header('location:login.php');
    exit(); // stop page execution
}

