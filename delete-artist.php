<?php
require 'includes/auth.php';
$title = 'Deleting Artist...';
require 'includes/header.php';

try {
    // get PK from url param and validate it
    if (isset($_GET['artistId'])) {
        if (is_numeric($_GET['artistId'])) {
            // connect
            require 'includes/db.php';

            // set up and and run SQL DELETE
            $userId = $_SESSION['userId'];

            // check for and delete artist photo if any
            $sql = "SELECT photo FROM artists WHERE artistId = :artistId AND userId = :userId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':artistId', $_GET['artistId'], PDO::PARAM_INT);
            $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
            $cmd->execute();
            $artist = $cmd->fetch();
            if (!empty($artist)) {
                if (!empty($artist['photo'])) {
                    unlink(realpath('img/' . $artist['photo']));
                }
            }

            // delete artist record
            $sql = "DELETE FROM artists WHERE artistId = :artistId AND userId = :userId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':artistId', $_GET['artistId'], PDO::PARAM_INT);
            $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
            $cmd->execute();

            // disconnect
            $db = null;

            // show confirmation
            echo '<div class="alert alert-info">Artist has been deleted.  
                    <a href="artists.php">Return to Artist List</a>
                    </div>';
        } else {
            echo '<div class="alert alert-warning">Artist Missing</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Artist Missing</div>';
    }
} catch (Exception $error) {
    header('location:error.php');
}
?>
</body>

</html>