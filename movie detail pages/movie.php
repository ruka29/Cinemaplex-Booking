<?php
session_start();

$movie_id = $_GET['movie_id'];

//establish a MySQL connection
$connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");
//verifying the connection
if(!$connection){
    die("Connection failed : " . mysqli_connect_error());
}

$queryMovieID = "SELECT movie_name, poster_path, landscape_path FROM movies WHERE movie_id = $movie_id";
$resultMovieID = mysqli_query($connection, $queryMovieID);

if (mysqli_num_rows($resultMovieID) > 0){
    while ($row = mysqli_fetch_assoc($resultMovieID)) {
    $movie_name = $row['movie_name'];
    $poster = $row['poster_path'];
    $landscape_img = $row['landscape_path'];
    }
}

$queryMovieDetail = "SELECT genres, duration, director, producer, writer FROM movie_details WHERE movie_id = $movie_id";
$resultMovieDetail = mysqli_query($connection, $queryMovieDetail);

if (mysqli_num_rows($resultMovieDetail) > 0){
    while ($row = mysqli_fetch_assoc($resultMovieDetail)) {
    $genres = $row['genres'];
    $duration = $row['duration'];
    $director = $row['director'];
    $producer = $row['producer'];
    $writer = $row['writer'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="movie_detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="../images/favicon.jpg">
    <title><?php echo $movie_name; ?> | Cinemaplex Booking</title>
</head>

<body>
    <!--navbar start-->
    <header id="header" class="primary-header flex">
        <div>
            <p class="logo">CINEMAPLEX BOOKING</p>
        </div>
        <nav>
            <ul id="primary-navigation" data-visible="false" class="primary-navigation flex">
                <li><a class="nav-links" href="../index.php">Home</a></li>
                <li><a class="nav-links" href="../movies/movies.php">Movies</a></li>
                <li><a class="nav-links" href="../account/account.php">Account</a></li>
                <li><a class="nav-links" href="../booking/select_movie.php">Buy Tickets</a></li>
                <?php
                if (!isset($_SESSION['user_id'])) {
                    echo "<li><a href='../login/login.html'><button id='login-btn' class='login-btn'>LOGIN</button></a></li>";
                } else {
                    echo "<li><a href='../login/logout.php'><button id='login-btn' class='login-btn'>LOGOUT</button></a></li>";
                }
                ?>
            </ul>
        </nav>
        <button class="mobile-nav-toggle" aria-controls="primary-navigation" aria-expanded="false"></button>
    </header>
    <script src="movie_detail.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) { // Adjust the scroll threshold as needed
                    $('#header').addClass('scrolled');
                } else {
                    $('#header').removeClass('scrolled');
                }
            });
        });
    </script>
    <!--navbar end-->

    <div class="background-image">
        <?php echo '<img src="../dashboard/' . $landscape_img . '" alt="">' ?>
    </div>

    <div class="content">
        <div class="poster">
            <?php echo '<img src="../dashboard/' . $poster . '" alt="">' ?>
        </div>
        <div class="movie-details">
            <div class="details">
                <h1><?php echo $movie_name ?></h1>
                <p class="genre">Genres : <?php echo $genres; ?></p>
                <p class="duration">Duration : <?php echo $duration; ?></p>
                <?php
                    echo '<form action="../booking/booking.php" method="post">
                    <input type="hidden" name="movie_id" value="' . $movie_id . '">
                    <input type="hidden" name="dynamic_location" value="booking/booking.php">
                    <button type="submit" class="buy-tickets">Buy Tickets</button>
                    </form>';
                ?>
                <!-- <a href="../booking/select_movie.php"><button class="buy-tickets">Buy Tickets</button></a> -->
            </div>
            <div class="members">
                <div class="cast">
                    <h2>CAST</h2>
                    <?php
                    $queryMovieCast = "SELECT actor_name, character_name FROM cast WHERE movie_id = $movie_id";
                    $resultMovieCast = mysqli_query($connection, $queryMovieCast);

                    if (mysqli_num_rows($resultMovieCast) > 0){
                        while ($row = mysqli_fetch_assoc($resultMovieCast)) {
                            echo '<p class="actor">' . $row['actor_name'] . '</p>
                            <p class="character">' . $row['character_name'] . '</p>';
                        }
                    }
                    ?>
                </div>
                <div class="crew">
                    <h2>CREW</h2>
                    <div>
                        <div class="title">
                            <p>Directed by</p>
                            <p>Produced by</p>
                            <p>Written by</p>
                        </div>
                        <div class="name">
                            <p><?php echo $director; ?></p>
                            <p><?php echo $producer; ?></p>
                            <p><?php echo $writer; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-col">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="movies/movies.php">Movies</a></li>
                    <li><a href="account/account.php">Account</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <a href="booking/select_movie.php"><button class="footer-btn">Buy Tickets</button></a>
            </div>
            <div class="footer-col">
                <h5>Follow Us</h5>
                <div class="links">
                    <a href="https://facebook.com"><i class="fa fa-facebook-f"></i></a>
                    <a href="https://instagram.com"><i class="fa fa-instagram"></i></a>
                    <a href="https://youtube.com"><i class="fa fa-youtube"></i></a>
                </div>
            </div>
            <p>© 2023 All Rights Reserved By Cinemaplex Booking</p>
        </div>
    </footer>
</body>

</html>