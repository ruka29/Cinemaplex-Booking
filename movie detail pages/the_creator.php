<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="movie_detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="../images/favicon.jpg">
    <title>The Creator | Cinemaplex Booking</title>
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
                    echo "<li><a href='login/login.html'><button id='login-btn' class='login-btn'>LOGIN</button></a></li>";
                } else {
                    echo "<li><a href='login/logout.php'><button id='login-btn' class='login-btn'>LOGOUT</button></a></li>";
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
        <img src="../images/the-creator.jpg" alt="">
    </div>

    <div class="content">
        <div class="poster">
            <img src="../images/the-creator-poster.jpg" alt="poster">
        </div>
        <div class="movie-details">
            <div class="details">
                <h1>The Creator</h1>
                <p class="genre">Genres : Action, Adventure, Drama</p>
                <p class="duration">Duration : 2h 15min</p>
                <a href="https://youtu.be/ex3C1-5Dhb8?si=jr67y9vx_IzN3H1-" target="_blank"><button class="buy-tickets">Watch Trailer</button></a>
            </div>
            <div class="members">
                <div class="cast">
                    <h2>CAST</h2>
                    <p class="actor">Gemma Chan</p>
                    <p class="character">Maya</p>
                    <p class="actor">Allison Janney</p>
                    <p class="character">Colonel Howell</p>
                    <p class="actor">John David Washington</p>
                    <p class="character">Joshua</p>
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
                            <p>Gareth Edwards</p>
                            <p>Gareth Edwards</p>
                            <p>Gareth Edwards , Chris Weitz</p>
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