<?php
$title = 'Register';
require 'includes/header.php';
?>

<main class="container">
    <h1>User Registration</h1>
    <h6 class="alert alert-secondary" id="message">Passwords must be a minimum of 8 characters, 
        including 1 digit, 1 upper-case letter, and 1 lower-case letter.
    </h6>
    <form method="post" action="save-registration.php">
        <fieldset class="m-1">
            <label for="username" class="col-2">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset class="m-1">
            <label for="password" class="col-2">Password:</label>
            <input type="password" name="password" id="password" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
            <img src="img/show.png" id="showHide" alt="Show/Hide Password" onclick="showHidePassword()" />
        </fieldset>
        <fieldset class="m-1">
            <label for="confirm" class="col-2">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>
        <div class="offset-2">
            <button class="btn btn-primary" onclick="return comparePasswords()">Register</button>
        </div>
    </form>
</main>

</body>
</html>