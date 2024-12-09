<?php
session_start();

if(isset($_POST['dynamic_location'])){
    $dynamicLocation = $_POST['dynamic_location'];
    $_SESSION["dynamic_location"] = $dynamicLocation;
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit;
}

$userID = $_SESSION['user_id'];

//establish a MySQL connection
$connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");
//verifying the connection
if (!$connection) {
    die("Connection failed : " . mysqli_connect_error());
}

//retrieve the list of movies from the database
$query = "SELECT movie_id, movie_name FROM movies";
$result = mysqli_query($connection, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/favicon.jpg">
    <title>Buy Tickets | Cinemaplex Booking</title>
    <link rel="stylesheet" href="select_movie.css">
</head>

<body>
    <div class="popup">
        <form class="movie-name" action="booking.php" method="post">
            <h1>Cinemaplex Booking</h1>
            <h3>Select a movie</h3>
            <div class="dropdown-btn">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    echo "<select name='movie_id' id='movie_id' required>";
                    // echo "<option value = '0'>Select a Movie</option>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value = '{$row['movie_id']}'>" . $row['movie_name'] . "</option>";
                    }
                    echo "</select>";
                }
                ?>
                <button id="continue" type="submit" name="submit">Continue</button>
            </div>
        </form>
    </div>
</body>

</html>