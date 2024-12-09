<?php
session_start();

if (isset($_POST['dynamic_location'])) {
    $dynamicLocation = $_POST['dynamic_location'];
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit;
}

$userID = $_SESSION['user_id'];

$connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");
//verifying the connection
if(!$connection){
    die("Connection failed : " . mysqli_connect_error());
}

$userName = null;

$queryUserName = "SELECT first_name FROM users WHERE id = '$userID'";
$resultUserName = mysqli_query($connection, $queryUserName);

if(mysqli_num_rows($resultUserName) > 0){
    $row = mysqli_fetch_assoc($resultUserName);
    $userName = $row['first_name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/favicon.jpg">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="account.css">
    <title>Account | Cinemaplex Booking</title>
</head>
<body style="background-color: #fff;">
    
    <!--navbar start-->
    <header class="primary-header flex" style="background-color: #333;">
        <div>
            <p class="logo">CINEMAPLEX BOOKING</p>
        </div>
        <nav>
            <ul id="primary-navigation" data-visible="false" class="primary-navigation flex">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../movies/movies.php">Movies</a></li>
                <li><a href="account.php" style="color: rgb(24, 255, 55)">Account</a></li>
                <li><a href="../booking/select_movie.php">Buy Tickets</a></li>
                <li><a href='../login/logout.php'><button id='login-btn' class='login-btn'>LOGOUT</button></a></li>
            </ul>
        </nav>
        <button class="mobile-nav-toggle" aria-controls="primary-navigation" aria-expanded="false"></button>
    </header>
    <script src="../script.js"></script>
    <!--navbar end-->

    <div class="account-container">
        <h3 class="heading">Welcome, <?php echo $userName?>!</h3>
        <table class="booking-table">
            <tr class="table-th">
                <th>Booking No.</th>
                <th>Movie Name</th>
                <th>Location</th>
                <th>Date</th>
                <th>Time</th>
                <th>Seat ID(s)</th>
                <th>Total</th>
                <th>Payment Status</th>
            </tr>
            <?php
            $query = "SELECT bookings.booking_id, movies.movie_name, showtimes.location, bookings.date, showtimes.time, bookings.seat_numbers, bookings.total 
            FROM bookings
            INNER JOIN movies ON bookings.movie_id = movies.movie_id
            INNER JOIN showtimes ON bookings.showtimes_id = showtimes.showtimes_id
            WHERE bookings.user_id = $userID";
            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr class='data-row'>
                <td>{$row['booking_id']}</td>
                <td>{$row['movie_name']}</td>
                <td>{$row['location']}</td>
                <td>{$row['date']}</td>
                <td>{$row['time']}</td>
                <td>{$row['seat_numbers']}</td>
                <td>{$row['total']}</td>
                <td>Pending</td>
                </tr>";
                }
            } else{
                echo "<tr><td colspan='8'>No bookings found</td></tr>";
            }
            ?>  
        </table>
        <div>
            <a href="../booking/select_movie.php"><button class="buy-tickets">Buy Tickets</button></a>
        </div>
    </div>
    
    <footer>
        <div class="footer-container">
            <div class="footer-col">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="movies/movies.php">Movies</a></li>
                    <li><a href="account/account.php" style="color: rgb(24, 255, 55)">Account</a></li>
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