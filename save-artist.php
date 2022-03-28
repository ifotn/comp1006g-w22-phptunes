<?php
require 'includes/auth.php';
$title = 'Saving Artist Details...';
require 'includes/header.php';

try {
    // get form input using the $_POST array and store in a local var (optional but helps simplify syntax)
    $name = trim($_POST['name']);
    $genreId = $_POST['genreId'];
    $artistId = $_POST['artistId'];
    $ok = true; // flag for form completion; used to determine whether to save or not

    // input validation
    if (empty($name)) {
        echo "Name is required<br />";
        $ok = false;
    } else {
        if (strlen($name) > 100) {
            echo "Name cannot exceed 100 characters";
            $ok = false;
        }
    }

    if (empty($genreId)) {
        echo "Genre is required<br />";
        $ok = false;
    } else {
        if (!is_numeric($genreId) || $genreId < 1) {
            echo "Genre must be a number greater than zero<br />";
            $ok = false;
        }
    }

    // evaluate the flag => is form complete?
    if ($ok) {
        // connect to the db using the PDO library w/5 vals: db type / server / dbname / username / password
        // PDO is the current PHP standard data access library, replacing mysqli
        require 'includes/db.php';

        if (empty($artistId)) {
            // set the SQL INSERT command to add a new record to our artists table & set up a parameter for the name
            $sql = "INSERT INTO artists (name, genreId) VALUES (:name, :genreId)";
        } else {
            $sql = "UPDATE artists SET name = :name, genreId = :genreId WHERE artistId = :artistId";
        }

        // populate our SQL command with our form inputs
        // -> is the PHP operator like the . operator in Java or C#
        // we can't use object.method in PHP because the . is for concatenation (stupidly!)
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
        $cmd->bindParam(':genreId', $genreId, PDO::PARAM_INT);

        // bind artistId param ONLY when we have 1 
        if (!empty($artistId)) {
            $cmd->bindParam(':artistId', $artistId, PDO::PARAM_INT);
        }

        // execute the save command
        $cmd->execute();

        // disconnect from db
        $db = null;

        // show the user a message
        echo '<p class="col-12 text-center">Artist Saved</p>';
        echo '<a href="artists.php">Click to View List of Artists</a>';
    }
} catch (Exception $error) {
    header('location:error.php');
}
?>
</body>

</html>