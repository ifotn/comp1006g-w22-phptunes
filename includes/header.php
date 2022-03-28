<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>PHP Tunes | <?php echo $title; ?></title>
    <!--Bootstrap-->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Custom CSS-->
    <link type="text/css" rel="stylesheet" href="css/styles.css" />
    <!--Custom JS-->
    <script src="js/scripts.js" type="text/javascript" defer></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">PHP Tunes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="artists.php">Artists</a>
                    </li>                
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php
                    // only call session start if not called previously in this http request
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    
                    if (empty($_SESSION['username'])) {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="register.php">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>';
                    }
                    else {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="#">' . $_SESSION['username'] . '</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>