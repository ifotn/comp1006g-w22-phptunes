<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Genre Details</title>
        <!--Bootstrap-->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    </head>
    <body>
        <main class="container">
            <h1>Genre Details</h1>
            <form method="POST" action="save-genre.php">
                <fieldset class="form-group">
                    <label for="name" class="control-label col-2">Name:</label>
                    <input name="name" id="name" />
                </fieldset>
                <button class="btn btn-primary offset-2 mt-2">Save</button>
            </form>
        </main>      
    </body>
</html>