<?php
session_start();
//establish a MySQL connection
$connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");
//verifying the connection
if (!$connection) {
    die("Connection failed : " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="movies.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="../images/favicon.jpg">
    <title>Movies | Cinemaplex Booking</title>
</head>

<body>
    <!--navbar start-->
    <header class="primary-header flex" style="background-color: #333;">
        <div>
            <p class="logo">CINEMAPLEX BOOKING</p>
        </div>
        <nav>
            <ul id="primary-navigation" data-visible="false" class="primary-navigation flex">
                <li><a href="../index.php">Home</a></li>
                <li><a href="movies.php" style="color: rgb(24, 255, 55)">Movies</a></li>
                <li><a href="../account/account.php">Account</a></li>
                <li><a href="../booking/select_movie.php">Buy Tickets</a></li>
                <?php
                if (!isset($_SESSION['user_id'])) {
                    echo '<li><form action="../login/login.php" method="post">
                    <input type="hidden" name="dynamic_location" value="movies/movies.php">
                    <button type="submit" class="login-btn" id="login-btn">LOGIN</button>
                    </form></li>';
                } else {
                    echo "<li><a href='../login/logout.php'><button id='login-btn' class='login-btn'>LOGOUT</button></a></li>";
                }
                ?>
            </ul>
        </nav>
        <button class="mobile-nav-toggle" aria-controls="primary-navigation" aria-expanded="false"></button>
    </header>
    <script src="../script.js"></script>
    <!--navbar end-->

    <!--now showing table start-->
    <div class="table-container">
    <table class="table-table">
        <tr>
            <th>
                <div>
                    <h3 class="table-heading">NOW SCREENING</h3>
                </div>
            </th>
        </tr>
        <?php
        
        // Retrieve movie data from the database
        $query = "SELECT movie_name, poster_path, trailer_link, movie_id FROM movies";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $count = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                if ($count % 4 === 0) {
                    echo '<tr class="table-tr">';
                }

                echo '<td class="table-td-1">
                <div class="column">
                    <img src="../dashboard/' . $row['poster_path'] . '" alt="' . $row['movie_name'] . '">
                    <a class="detail-link" href="../movie detail pages/movie.php?movie_id=' . $row['movie_id'] . '">
                    <div class="content">
                        <h3>' . $row['movie_name'] . '</h3>
                        <div class="content-trailer">
                            <a class="trailer" href="' . $row['trailer_link'] . '" target="_blank">Watch Trailer</a>
                        </div>
                        <div class="content-book">
                            <form action="../booking/booking.php" method="post">
                            <input type="hidden" name="movie_id" value="' . $row['movie_id'] . '">
                            <input type="hidden" name="dynamic_location" value="booking/booking.php">
                            <button type="submit" class="book">Buy Tickets</button>
                            </form>
                        </div>
                    </div>
                    </a>
                </div>
                </td>';

                $count++;

                if ($count % 4 === 0) {
                    echo '</tr>';
                }
            }

            // If the loop ends with an open row, close it
            if ($count % 4 !== 0) {
                echo '</tr>';
            }
        }

        // Close the database connection
        mysqli_close($connection);
        ?>
    </table>
</div>

    <!--now showing table end-->

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
                        <img src="../images/the-marvels-poster.jpg" alt="image1">
                        <a class="detail-link" href="../movie detail pages/the_marvels.php">
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
                        <img src="../images/wish-poster.jpg" alt="image2">
                        <a class="detail-link" href="../movie detail pages/wish.php">
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
                        <img src="../images/the-creator-poster.jpg" alt="image3">
                        <a class="detail-link" href="../movie detail pages/the_creator.php">
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
                        <img src="../images/the-hunger-games-poster.jpg" alt="image4">
                        <a class="detail-link" href="../movie detail pages/the_hunger_games.php">
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

    <footer>
        <div class="footer-container">
            <div class="footer-col">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="movies/movies.php" style="color: rgb(24, 255, 55)">Movies</a></li>
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