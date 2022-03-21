<?php
$title = 'Login';
require 'includes/header.php';
?>

<main class="container">
    <h1>Login</h1>
    <?php
    if (empty($_GET['invalid'])) {
        echo '<h6 class="alert alert-secondary">Please enter your credentials</h6>';
    }
    else {
        echo '<h6 class="alert alert-info">Invalid Login</h6>';
    }
    ?>
    <form method="post" action="validate.php">
        <fieldset class="m-1">
            <label for="username" class="col-2">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset class="m-1">
            <label for="password" class="col-2">Password:</label>
            <input type="password" name="password" id="password" required />
        </fieldset>
        <div class="offset-2">
            <button class="btn btn-primary">Login</button>
        </div>
    </form>
</main>

</body>
</html>