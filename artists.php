<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Artists</title>
        <!--Bootstrap-->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
        <!-- Custom CSS-->
        <link type="text/css" rel="stylesheet" href="css/styles.css" />
    </head>
    <body>
        <h1>Artists</h1>
        <a href="artist-details.php">Add a New Artist</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Genre</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // connect
                require 'db.php';

                // set up & run query
                $sql = "SELECT artists.*, genres.name as 'genreName' FROM artists INNER JOIN genres ON artists.genreId = genres.genreId";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $artists = $cmd->fetchAll();

                // loop through results and display inside table cells
                foreach ($artists as $artist) {
                    echo '<tr>
                        <td>' . $artist['name'] . '</td>
                        <td>'. $artist['genreName'] . '</td>
                        </tr>';
                }

                // disconnect
                $db = null;
                ?>
            </tbody>
        </table>
    </body>
</html>