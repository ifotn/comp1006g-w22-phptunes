<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Saving Genre Details...</title>
    </head>
    <body>
        <?php
        // get form input using the $_POST array and store in a local var (optional but helps simplify syntax)
        $name = $_POST['name'];

        // connect to the db using the PDO library w/5 vals: db type / server / dbname / username / password
        // PDO is the current PHP standard data access library, replacing mysqli
        require 'db.php';

        // set the SQL INSERT command to add a new record to our genres table & set up a parameter for the name
        $sql = "INSERT INTO genres (name) VALUES (:name)";

        // populate our SQL command with our form inputs
        // -> is the PHP operator like the . operator in Java or C#
        // we can't use object.method in PHP because the . is for concatenation (stupidly!)
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);

        // execute the save command
        $cmd->execute();

        // disconnect from db
        $db = null;

        // show the user a message
        echo "Genre Saved";
        ?>
    </body>
</html>