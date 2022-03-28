<?php
// capture form inputs
$username = $_POST['username'];
$password = $_POST['password'];

// connect
require 'includes/db.php';

// check for username only first
$sql = "SELECT * FROM users WHERE username = :username";
$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();
$user = $cmd->fetch();

// if username not found, redirect to login w/error indicator
if (!$user) {
    $db = null;
    header('location:login.php?invalid=true');
}
else {
    // if username found, hash and compare the password entered w/the hashed password in the db query result
    if (!password_verify($password, $user['password'])) {
        // if passwords don't match, redirect to login w/error indicator
        $db = null;
        header('location:login.php?invalid=true');
    }
    else {
           // login is valid: access session object, store identity in session var, redirect to main artists page
           session_start();
           $_SESSION['username'] = $username;
           $_SESSION['userId'] = $user['userId'];
           header('location:artists.php');
    }
}

?>