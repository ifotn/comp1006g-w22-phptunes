<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Saving Artist Details...</title>
    </head>
    <body>
        <?php
        // get form input using the $_POST array and store in a local var (optional but helps simplify syntax)
        $name = $_POST['name'];
        echo "Artist Name: $name";
        
        ?>
    </body>
</html>