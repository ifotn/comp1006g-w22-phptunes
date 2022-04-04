<?php
require 'includes/auth.php';
$title = 'Artist Details';
require 'includes/header.php';

try {
    // check for artistId url param.  if we have one, query db & populate form.  if not show blank form
    $artistId = null;
    $name = null;
    $genreId = null;
    $photo = null;

    if (isset($_GET['artistId'])) {
        if (is_numeric($_GET['artistId'])) {
            $artistId = $_GET['artistId'];

            require 'includes/db.php';

            // add userId filter so users can only see their own artists
            $userId = $_SESSION['userId'];
            $sql = "SELECT * FROM artists WHERE artistId = :artistId AND userId = :userId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':artistId', $artistId, PDO::PARAM_INT);
            $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
            $cmd->execute();
            $artist = $cmd->fetch();  // use fetch() not fetchAll() for single-row queries
            if (empty($artist)) {
                $db = null;
                header('location:error.php');
                exit();
            }
            else {
                $name = $artist['name'];
                $genreId = $artist['genreId'];
                $photo = $artist['photo'];
                $db = null;                
            }
        }
    }
}
catch (Exception $error) {
    header('location:error.php');
}
?>
<main class="container">
    <h1>Artist Details</h1>
    <p class="alert alert-secondary">* indicates required fields.</p>
    <form method="POST" action="save-artist.php" enctype="multipart/form-data">
        <fieldset class="form-group m-1">
            <label for="name" class="control-label col-2">Name: *</label>
            <input name="name" id="name" required maxlength="100" value="<?php echo $name; ?>" />
        </fieldset>
        <fieldset class="form-group m-1">
            <label for="genreId" class="control-label col-2">Genre: *</label>
            <select name="genreId" id="genreId">
                <?php
                try {
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
                }
                catch (Exception $error) {
                    header('location:error.php');
                }
                ?>
            </select>
        </fieldset>
        <fieldset class="form-group m-1">
            <label for="photo" class="control-label col-2">Photo:</label>
            <input type="file" name="photo" id="photo" accept=".png,.jpg,.jpeg" />
        </fieldset>
        <?php
        if (!empty($photo)) {
            echo '<div><img src="img/' . $photo . '" alt="Artist Photo" /></div>';
        }
        ?>
        <input type="hidden" name="artistId" id="artistId" value="<?php echo $artistId; ?>" />
        <button class="btn btn-primary offset-2 mt-2">Save</button>
    </form>
</main>
</body>

</html>