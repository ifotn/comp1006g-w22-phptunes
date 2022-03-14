<?php
$title = 'Artist Details';
require 'includes/header.php';

// check for artistId url param.  if we have one, query db & populate form.  if not show blank form
$artistId = null;
$name = null;
$genreId = null;

if (isset($_GET['artistId'])) {
    if (is_numeric($_GET['artistId'])) {
        $artistId = $_GET['artistId'];

        require 'includes/db.php';
        $sql = "SELECT * FROM artists WHERE artistId = :artistId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':artistId', $artistId, PDO::PARAM_INT);
        $cmd->execute();
        $artist = $cmd->fetch();  // use fetch() not fetchAll() for single-row queries
        $name = $artist['name'];
        $genreId = $artist['genreId'];
        $db = null;
    }
}

?>
<main class="container">
    <h1>Artist Details</h1>
    <p class="alert alert-secondary">All fields are required.</p>
    <form method="POST" action="save-artist.php">
        <fieldset class="form-group m-1">
            <label for="name" class="control-label col-2">Name:</label>
            <input name="name" id="name" required maxlength="100" value="<?php echo $name; ?>" />
        </fieldset>
        <fieldset class="form-group m-1">
            <label for="genreId" class="control-label col-2">Genre:</label>
            <select name="genreId" id="genreId">
                <?php
                require 'includes/db.php';

                $sql = "SELECT * FROM genres";

                $cmd = $db->prepare($sql);
                $cmd->execute();
                $genres = $cmd->fetchAll();

                foreach ($genres as $genre) {
                    if ($genre['genreId'] == $genreId) {
                        echo '<option selected value="' . $genre['genreId'] . '">' . $genre['name'] . '</option>';
                    } else {
                        echo '<option value="' . $genre['genreId'] . '">' . $genre['name'] . '</option>';
                    }
                }

                $db = null;
                ?>
            </select>
        </fieldset>
        <input type="hidden" name="artistId" id="artistId" value="<?php echo $artistId; ?>" />
        <button class="btn btn-primary offset-2 mt-2">Save</button>
    </form>
</main>
</body>

</html>