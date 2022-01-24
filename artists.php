<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Artists</title>
        <!--Bootstrap-->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    </head>
    <body>
        <h1>Artists</h1>
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
                $db = new PDO('mysql:host=127.0.0.1;dbname=phptunes', 'root', '');

                // set up & run query
                $sql = "SELECT * FROM artists";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $artists = $cmd->fetchAll();

                // loop through results and display inside table cells
                foreach ($artists as $artist) {
                    echo '<tr>
                        <td>' . $artist['name'] . '</td>
                        <td>'. $artist['genreId'] . '</td>
                        </tr>';
                }

                // disconnect
                $db = null;
                ?>
            </tbody>
        </table>
    </body>
</html>