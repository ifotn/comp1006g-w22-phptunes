<?php
require 'includes/auth.php';
$title = 'My Artists';
require 'includes/header.php';
?>
<h1>My Artists</h1>
<a href="artist-details.php">Add a New Artist</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Genre</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        try {
            // connect
            require 'includes/db.php';

            // set up & run query
            // now filter for the authenticated user by their userId stored in a session var
            $sql = "SELECT artists.*, genres.name as 'genreName' FROM artists 
                INNER JOIN genres ON artists.genreId = genres.genreId
                WHERE userId = :userId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':userId', $_SESSION['userId'], PDO::PARAM_INT);
            $cmd->execute();
            $artists = $cmd->fetchAll();

            // loop through results and display inside table cells
            foreach ($artists as $artist) {
                echo '<tr>
                        <td>
                            <a href="artist-details.php?artistId=' . $artist['artistId'] . '">' . $artist['name'] . '</a>
                        </td>
                        <td>' . $artist['genreName'] . '</td>
                        <td>
                            <a href="delete-artist.php?artistId=' . $artist['artistId'] . '" class="btn btn-danger"
                                onclick="return confirmDelete()">
                                Delete
                            </a>
                        </td>
                        </tr>';
            }

            // disconnect
            $db = null;
        } catch (Exception $error) {
            header('location:error.php'); // redirect to error page
        }
        ?>
    </tbody>
</table>
</body>

</html>