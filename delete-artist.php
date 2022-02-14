<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Deleting Artist...</title>
        <!--Bootstrap-->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
        <!-- Custom CSS-->
        <link type="text/css" rel="stylesheet" href="css/styles.css" />
        <!--Custom JS-->
        <script src="js/scripts.js" type="text/javascript" defer></script>
    </head>
    <body>
        <h1>Deleting Artist...</h1>
        <?php
        // get PK from url param and validate it
        if (isset($_GET['artistId'])) {
            if (is_numeric($_GET['artistId'])) {
                // connect
                require 'db.php';

                // set up and and run SQL DELETE
                $sql = "DELETE FROM artists WHERE artistId = :artistId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':artistId', $_GET['artistId'], PDO::PARAM_INT);
                $cmd->execute();

                // disconnect
                $db = null;

                // show confirmation
                echo '<div class="alert alert-info">Artist has been deleted.  
                    <a href="artists.php">Return to Artist List</a>
                    </div>';
            }
            else {
                echo '<div class="alert alert-warning">Artist Missing</div>';
            }
        }
        else {
            echo '<div class="alert alert-warning">Artist Missing</div>';
        }
        ?>
    </body>
</html>