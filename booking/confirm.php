<?php
session_start();

$userID = $_SESSION['user_id'];

//establish a MySQL connection
$connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");
//verifying the connection
if (!$connection) {
    die("Connection failed : " . mysqli_connect_error());
}

$movieId = null;
$showtimeId = null;

$movie_name = $_POST['movie_name'];
$date = $_POST['date'];
$time = $_POST['time'];
$location = $_POST['location'];
$no_seats = $_POST['no_seats'];
$seat_numbers = $_POST['seat_numbers'];
$total = $_POST['total'];

$queryMovieId = "SELECT movie_id FROM movies WHERE movie_name = '$movie_name'";
$resultMovieId = mysqli_query($connection, $queryMovieId);

if (mysqli_num_rows($resultMovieId) > 0) {
    $row = mysqli_fetch_assoc($resultMovieId);
    $movieId = $row['movie_id'];
}

$queryShowtimeId = "SELECT showtimes_id FROM movies WHERE movie_name = '$movie_name'";
$resultShowtimeId = mysqli_query($connection, $queryShowtimeId);

if (mysqli_num_rows($resultShowtimeId) > 0) {
    $row = mysqli_fetch_assoc($resultShowtimeId);
    $showtimeId = $row['showtimes_id'];
}

$query = "INSERT INTO bookings (user_id, movie_id, date, showtimes_id, no_seats, seat_numbers, total) VALUES
('$userID', '$movieId', '$date', '$showtimeId', '$no_seats', '$seat_numbers', '$total')";

if (mysqli_query($connection, $query)) {
    $msg = "Booking Successfull!";
    // header('Location: ../account/account.php');
} else {
    echo 'Error: ' . $query . "<br>" . mysqli_error($connection);
}



//colse the databse connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="confirm.css">
    <link rel="icon" type="image/x-icon" href="../images/favicon.jpg">
    <title>Confirm | Cinemaplex Booking</title>
</head>

<body>
    <div class="container">
        <div class="confirm-form">
            <h1>Cinemaplex Booking</h1>

            <?php
            if (isset($msg)) :
            ?>
                <p style="color: rgb(24, 255, 55); font-size: 18px;">
                    <?php
                    echo $msg;
                    ?>
                </p>
            <?php
            endif;
            ?>
            <div class="btn">
                <a href="../account/account.php"><button>View Bookings</button></a>
                <a id="home-link" href="../index.php">Home</a>
            </div>

        </div>

        <script src="confirm.js"></script>
    </div>
</body>

</html>