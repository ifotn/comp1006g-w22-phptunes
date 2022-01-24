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
        $genreId = $_POST['genreId'];

        // connect to the db using the PDO library w/5 vals: db type / server / dbname / username / password
        // PDO is the current PHP standard data access library, replacing mysqli
        require 'db.php';

        // set the SQL INSERT command to add a new record to our artists table & set up a parameter for the name
        $sql = "INSERT INTO artists (name, genreId) VALUES (:name, :genreId)";

        // populate our SQL command with our form inputs
        // -> is the PHP operator like the . operator in Java or C#
        // we can't use object.method in PHP because the . is for concatenation (stupidly!)
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
        $cmd->bindParam(':genreId', $genreId, PDO::PARAM_INT);

        // execute the save command
        $cmd->execute();

        // disconnect from db
        $db = null;

        // show the user a message
        echo "Artist Saved";
        ?>
    </body>
</html>