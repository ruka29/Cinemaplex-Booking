<?php
session_start();

//establish a MySQL connection
$connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");
//verifying the connection
if(!$connection){
    die("Connection failed : " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Cinemaplex Booking</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.jpg">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="background-color: #242333;">

    <!--navbar start-->
    <header id="header" class="primary-header flex" style="align-items: center;">
        <div>
            <p class="logo">CINEMAPLEX BOOKING</p>
        </div>
        <nav>
            <ul id="primary-navigation" data-visible="false" class="primary-navigation flex">
                <li><a href="index.php" style="color: rgb(24, 255, 55)">Home</a></li>
                <li><a href="movies/movies.php">Movies</a></li>
                <li>
                <?php
                    echo '<form action="account/account.php" method="post">
                        <input type="hidden" name="dynamic_location" value="account/account.php">
                        <button type="submit" class="account-buyticket">Account</button>
                        </form>';
                    ?>
                </li>
                <li>
                    <?php
                    echo '<form action="booking/select_movie.php" method="post">
                        <input type="hidden" name="dynamic_location" value="booking/select_movie.php">
                        <button type="submit" class="account-buyticket">Buy Tickets</button>
                        </form>';
                    ?>
                </li>
                <?php
                if (!isset($_SESSION['user_id'])) {
                    echo '<li><form action="login/login.php" method="post">
                    <input type="hidden" name="dynamic_location" value="index.php">
                    <button type="submit" class="login-btn" id="login-btn">LOGIN</button>
                    </form></li>';
                } else {
                    echo "<li><a href='login/logout.php'><button id='login-btn' class='login-btn'>LOGOUT</button></a></li>";
                }
                ?>
            </ul>
        </nav>
        <button class="mobile-nav-toggle" aria-controls="primary-navigation" aria-expanded="false"></button>
    </header>
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

    <!--carousel start-->
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <h3 class="now-showing">NOW SHOWING</h3>
            <div class="carousel-item active">
                <?php
                $queryMovieID = "SELECT * FROM movies LIMIT 1";
                $resultMovieID = mysqli_query($connection, $queryMovieID);
                
                if (mysqli_num_rows($resultMovieID) > 0){
                    while ($row = mysqli_fetch_assoc($resultMovieID)) {
                        $movie_id = $row['movie_id'];
                        $movie_name = $row['movie_name'];
                        $landscape_img = $row['landscape_path'];
                    }
                }

                $queryDirector = "SELECT director FROM movie_details WHERE movie_id = $movie_id";
                $resultDirector = mysqli_query($connection, $queryDirector);

                if (mysqli_num_rows($resultDirector) > 0){
                    $row = mysqli_fetch_assoc($resultDirector);
                    $director = $row['director'];
                }

                echo '<div class="overlay-image" style="background-image: url(dashboard/' . $landscape_img . '); position: absolute; bottom: 0; left: 0; right: 0; top: 0; background-position: center; background-size: cover; opacity: 0.5;">
                </div>
                <div class="container">
                    <h1>' . $movie_name . '</h1>
                    <p>by ' . $director . '</p>
                    <form action="booking/booking.php" method="post">
                    <input type="hidden" name="movie_id" value="' . $movie_id . '">
                    <input type="hidden" name="dynamic_location" value="booking/booking.php">
                    <button type="submit" class="btn btn-lg btn-primary" style="padding: 0.25em 2rem; border-radius: 5px; border: none; background-color: rgb(24, 255, 55); color: #000;">Buy Tickets</button>
                    </form>'.
                '</div>'
                ?>
            </div>
            <div class="carousel-item">
            <?php
                $queryMovieID = "SELECT * FROM movies LIMIT 1 OFFSET 1";
                $resultMovieID = mysqli_query($connection, $queryMovieID);
                
                if (mysqli_num_rows($resultMovieID) > 0){
                    while ($row = mysqli_fetch_assoc($resultMovieID)) {
                        $movie_id = $row['movie_id'];
                        $movie_name = $row['movie_name'];
                        $landscape_img = $row['landscape_path'];
                    }
                }

                $queryDirector = "SELECT director FROM movie_details WHERE movie_id = $movie_id";
                $resultDirector = mysqli_query($connection, $queryDirector);

                if (mysqli_num_rows($resultDirector) > 0){
                    $row = mysqli_fetch_assoc($resultDirector);
                    $director = $row['director'];
                }

                echo '<div class="overlay-image" style="background-image: url(dashboard/' . $landscape_img . '); position: absolute; bottom: 0; left: 0; right: 0; top: 0; background-position: center; background-size: cover; opacity: 0.5;">
                </div>
                <div class="container">
                    <h1>' . $movie_name . '</h1>
                    <p>by ' . $director . '</p>
                    <form action="booking/booking.php" method="post">
                    <input type="hidden" name="movie_id" value="' . $movie_id . '">
                    <input type="hidden" name="dynamic_location" value="booking/booking.php">
                    <button type="submit" class="btn btn-lg btn-primary" style="padding: 0.25em 2rem; border-radius: 5px; border: none; background-color: rgb(24, 255, 55); color: #000;">Buy Tickets</button>
                    </form>'.
                '</div>'
                ?>
            </div>
            <div class="carousel-item">
            <?php
                $queryMovieID = "SELECT * FROM movies LIMIT 1 OFFSET 2";
                $resultMovieID = mysqli_query($connection, $queryMovieID);
                
                if (mysqli_num_rows($resultMovieID) > 0){
                    while ($row = mysqli_fetch_assoc($resultMovieID)) {
                        $movie_id = $row['movie_id'];
                        $movie_name = $row['movie_name'];
                        $landscape_img = $row['landscape_path'];
                    }
                }

                $queryDirector = "SELECT director FROM movie_details WHERE movie_id = $movie_id";
                $resultDirector = mysqli_query($connection, $queryDirector);

                if (mysqli_num_rows($resultDirector) > 0){
                    $row = mysqli_fetch_assoc($resultDirector);
                    $director = $row['director'];
                }

                echo '<div class="overlay-image" style="background-image: url(dashboard/' . $landscape_img . '); position: absolute; bottom: 0; left: 0; right: 0; top: 0; background-position: center; background-size: cover; opacity: 0.5;">
                </div>
                <div class="container">
                    <h1>' . $movie_name . '</h1>
                    <p>by ' . $director . '</p>
                    <form action="booking/booking.php" method="post">
                    <input type="hidden" name="movie_id" value="' . $movie_id . '">
                    <input type="hidden" name="dynamic_location" value="booking/booking.php">
                    <button type="submit" class="btn btn-lg btn-primary" style="padding: 0.25em 2rem; border-radius: 5px; border: none; background-color: rgb(24, 255, 55); color: #000;">Buy Tickets</button>
                    </form>'.
                '</div>'
                ?>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev" style="height: 80vh;">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next" style="height: 80vh;">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!--carousel end-->

    <div class="more-link">
        <a href="movies/movies.php">View More <svg class="arrow" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                <style>
                    svg {
                        fill: #ffffff
                    }
                </style>
                <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
            </svg>
        </a>
    </div>

    <!--coming soon table start-->
    <div class="table-container-2">
        <table class="table-table">
            <tr>
                <th>
                    <div>
                        <h3 class="table-heading">COMING SOON</h3>
                    </div>
                </th>
            </tr>
            <tr>
                <td class="table-td-1">
                    <div class="column">
                        <img src="images/the-marvels-poster.jpg" alt="image1">
                        <a class="detail-link" href="movie detail pages/the_marvels.php">
                            <div class="content">
                                <h3>The Marvels</h3>
                                <div class="content-trailer">
                                    <a class="trailer" href="https://youtu.be/wS_qbDztgVY?si=TbmLKdH98KcMH6uk" target="_blank">Watch Trailer</a>
                                </div>
                            </div>
                    </div>
                </td>
                <td class="table-td-2">
                    <div class="column">
                        <img src="images/wish-poster.jpg" alt="image2">
                        <a class="detail-link" href="movie detail pages/wish.php">
                            <div class="content">
                                <h3>Wish</h3>
                                <div class="content-trailer">
                                    <a class="trailer" href="https://youtu.be/oyRxxpD3yNw?si=5iYe2bab-mknnq8S" target="_blank">Watch Trailer</a>
                                </div>
                            </div>
                    </div>
                </td>
                <td class="table-td-3">
                    <div class="column">
                        <img src="images/the-creator-poster.jpg" alt="image3">
                        <a class="detail-link" href="movie detail pages/the_creator.php">
                            <div class="content">
                                <h3>The Creator</h3>
                                <div class="content-trailer">
                                    <a class="trailer" href="https://youtu.be/ex3C1-5Dhb8?si=jr67y9vx_IzN3H1-" target="_blank">Watch Trailer</a>
                                </div>
                            </div>
                    </div>
                </td>
                <td class="table-td-4">
                    <div class="column">
                        <img src="images/the-hunger-games-poster.jpg" alt="image4">
                        <a class="detail-link" href="movie detail pages/the_hunger_games.php">
                            <div class="content">
                                <h3>The Hunger Games</h3>
                                <div class="content-trailer">
                                    <a class="trailer" href="https://youtu.be/RDE6Uz73A7g?si=DTTB5JaBfjALTMaE" target="_blank">Watch Trailer</a>
                                </div>
                            </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <!--coming soon table end-->

    <div class="more-link">
        <a href="movies/movies.php">View More <svg class="arrow" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                <style>
                    svg {
                        fill: #ffffff
                    }
                </style>
                <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
            </svg></a>
    </div>

    <div class="discounts-promotions">
        <h3>Discounts and Promotions</h3>
        <div class="promotion-container">
            <div class="promotion">
                <div>
                    <h4>Family Friday</h4>
                    <p>Every Friday, buy two adult tickets and get one child's ticket free for family-friendly movies.</p>
                </div>
                <img src="images/family-promotion.jpg" alt="promotion image">
            </div>
            <div class="promotion">
                <img src="images/combo-deal-promotion.jpg" alt="promotion image">
                <div>
                    <h4>Combo Deal</h4>
                    <p>Get a large popcorn and two medium sodas for the price of a small combo when you book online.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>

    <footer>
        <div class="footer-container">
            <div class="footer-col">
                <ul>
                    <li><a href="index.php" style="color: rgb(24, 255, 55)">Home</a></li>
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