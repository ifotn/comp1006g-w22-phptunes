<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Genres</title>
        <!--Bootstrap-->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    </head>
    <body>
        <?php
        // connect
        require 'db.php';

        // query the genres table using a SELECT command
        $sql = "SELECT * FROM genres";
        $cmd = $db->prepare($sql);
        $cmd->execute();
        // use PDO fetchAll() method to store resultset from db query in an array
        $genres = $cmd->fetchAll();

        echo '<ul class="list-group">';

        // loop through the data & display each genre using echo
        // $genres: whole dataset.  $genre: current record in the loop
        foreach ($genres as $genre) {
            echo '<li class="list-group-item">' . $genre['name'] . '</li>';
        }

        echo '</ul>';

        // disconnect
        $db = null;
        ?>
    </body>
</html>