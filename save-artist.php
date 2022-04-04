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
    $photo = $_FILES['photo'];  // photo upload optional

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

    // photo upload validation
    if (!empty($photo['name'])) {
        $file = $_FILES['photo'];
        $photo = $file['name'];
        $tmpName = $file['tmp_name'];

        // validate image only
        if ((mime_content_type($tmpName) != 'image/png') && (mime_content_type($tmpName) != 'image/jpeg')) {
            echo "Photo must be a valid PNG or JPG file";
            $ok = false;
        }
        else {
            // use session object to create new unique name to prevent overwrites
            // e.g. mypic.png => 298347asdflk-mypic.png
            $photo = session_id() . '-'. $photo;

            // save to img directory
            move_uploaded_file($tmpName, 'img/' . $photo);
        }         
    }
    else {
        // add logic to keep existing photo if any so it doesn't get accidentally removed
        $photo = null;
    }

    // evaluate the flag => is form complete?
    if ($ok) {
        // connect to the db using the PDO library w/5 vals: db type / server / dbname / username / password
        // PDO is the current PHP standard data access library, replacing mysqli
        require 'includes/db.php';

        // set userId var from session var
        $userId = $_SESSION['userId'];

        if (empty($artistId)) {
            // set the SQL INSERT command to add a new record to our artists table & set up a parameter for the name
            $sql = "INSERT INTO artists (name, genreId, userId, photo) VALUES (:name, :genreId, :userId, :photo)";
        } else {
            $sql = "UPDATE artists SET name = :name, genreId = :genreId, userId = :userId,
                photo = :photo WHERE artistId = :artistId";
        }

        // populate our SQL command with our form inputs
        // -> is the PHP operator like the . operator in Java or C#
        // we can't use object.method in PHP because the . is for concatenation (stupidly!)
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
        $cmd->bindParam(':genreId', $genreId, PDO::PARAM_INT);
        $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
        $cmd->bindParam(':photo', $photo, PDO::PARAM_STR, 100);

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