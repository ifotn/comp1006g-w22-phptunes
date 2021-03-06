<?php
$title = 'Artists';
require 'includes/header.php';
?>
<h1>Artists</h1>
<?php
if (!empty($_SESSION['username'])) {
    echo '<a href="artist-details.php">Add a New Artist</a>';
}
?>  
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Genre</th>
        </tr>
    </thead>
    <tbody>
        <?php
        try {
            // connect
            require 'includes/db.php';

            // set up & run query
            $sql = "SELECT artists.*, genres.name as 'genreName' FROM artists 
                INNER JOIN genres ON artists.genreId = genres.genreId
                GROUP BY artists.artistId, artists.name, artists.genreId, genres.name";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $artists = $cmd->fetchAll();

            // loop through results and display inside table cells
            foreach ($artists as $artist) {
                echo '<tr>
                        <td>' . $artist['name'] . '</td>
                        <td>' . $artist['genreName'] . '</td>
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