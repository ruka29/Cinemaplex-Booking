<?php
session_start();

if (isset($_POST['dynamic_location'])){
    $dynamicLocation = $_POST['dynamic_location'];
    $_SESSION['dynamic_location'] = $dynamicLocation;
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit;
}

//establish a MySQL connection
$connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");
//verifying the connection
if (!$connection) {
    die("Connection failed : " . mysqli_connect_error());
}

if (isset($_POST['movie_id'])) {
    $movie_id = $_POST["movie_id"];

    // First, get the associated showtime_id
    $queryShowtime = "SELECT showtimes_id FROM bookings WHERE movie_id = $movie_id";
    $resultShowtime = mysqli_query($connection, $queryShowtime);

    if (mysqli_num_rows($resultShowtime) > 0) {
        $row = mysqli_fetch_assoc($resultShowtime);
        $showtime_id = $row['showtimes_id'];

        // Now, get the seat_numbers for that showtime_id
        $querySeatNumbers = "SELECT seat_numbers FROM bookings WHERE showtimes_id = $showtime_id";
        $resultSeatNumbers = mysqli_query($connection, $querySeatNumbers);

        if (mysqli_num_rows($resultSeatNumbers) > 0) {
            $seatNumbersArray = array();

            while ($seatRow = mysqli_fetch_assoc($resultSeatNumbers)) {
                // Split the seat_numbers into an array assuming they are comma-separated
                $seatNumbers = explode(',', $seatRow['seat_numbers']);
                $seatNumbersArray = array_merge($seatNumbersArray, $seatNumbers);
            }
            // Convert $seatNumbersArray to a JSON string
            $seatNumbersJSON = json_encode($seatNumbersArray);

            // Output the JSON string as JavaScript variable
            echo "<script>var seatNumbers = $seatNumbersJSON;</script>";
        } else {
            // Handle the case where there are no seat numbers for the showtime
            echo "<script>var seatNumbers = [];</script>";
        }
    } else {
        // Handle the case where there are no showtimes for the movie
        echo "<script>var seatNumbers = [];</script>";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/favicon.jpg">
    <title>Buy Tickets | Cinemaplex Booking</title>
    <link rel="stylesheet" href="booking.css">
</head>

<body>
    <div class="all">
        <div class="movie-select">
            <div class="movie-name">
                <label for="movie">Movie</label>
                <select name='movie_name' id='movie_name'>
                    <?php
                    if (isset($_POST['movie_id'])) {
                        $movie_id = $_POST['movie_id'];

                        $queryName = "SELECT movie_name FROM movies WHERE movie_id = $movie_id";
                        $resultName = mysqli_query($connection, $queryName);
                    } 
                    if (mysqli_num_rows($resultName) > 0) {
                        $row = mysqli_fetch_assoc($resultName);
                        $movieName = $row['movie_name'];
                        echo "<option value = '$movieName'>" . $movieName . "</option>";
                    }
                    ?>
                    <script>
                        var movieName = <?php echo json_encode($movieName); ?>;
                    </script>
                </select>
            </div>
            <div class="date">
                <label for="date">Date</label>
                <select name="date" id="date">
                    <?php
                    $today = date("Y-m-d");
                    for ($i = 0; $i < 7; $i++) {
                        $date = date("Y-m-d", strtotime($today . " + $i days"));
                        echo "<option value='$date'>$date</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="time">
                <label for="time">Time</label>
                <select name="time" id="time">
                    <?php
                    if (isset($_POST['movie_id'])) {
                        $movie_id = $_POST['movie_id'];

                        $queryTime = "SELECT showtimes.showtimes_id, showtimes.time, movies.movie_id FROM showtimes JOIN movies ON showtimes.showtimes_id = movies.movie_id WHERE movie_id = $movie_id";
                        $resultTime = mysqli_query($connection, $queryTime);
                    }

                    if (mysqli_num_rows($resultTime) > 0) {
                        $row = mysqli_fetch_assoc($resultTime);
                        $timeSelected = $row['time'];
                        echo "<option value = '$timeSelected'>" . $timeSelected . "</option>";
                    }
                    ?>
                    <script>
                        var timeSelected = <?php echo json_encode($timeSelected); ?>;
                    </script>
                </select>
            </div>
            <div class="location">
                <label for="location">Location</label>
                <select name="location" id="location">
                    <?php
                    if (isset($_POST['movie_id'])) {
                        $movie_id = $_POST['movie_id'];

                        $queryLocation = "SELECT showtimes.showtimes_id, showtimes.location, movies.movie_id FROM showtimes JOIN movies ON showtimes.showtimes_id = movies.movie_id WHERE movie_id = $movie_id";
                        $resultLocation = mysqli_query($connection, $queryLocation);
                    }

                    if (mysqli_num_rows($resultLocation) > 0) {
                        $row = mysqli_fetch_assoc($resultLocation);
                        $locationSelected = $row['location'];
                        echo "<option value = '$locationSelected'>" . $locationSelected . "</option>";
                    }
                    ?>
                    <script>
                        var locationSelected = <?php echo json_encode($locationSelected); ?>;
                    </script>
                </select>
            </div>
            <a href="select_movie.php"><button id="different_movie">Select a different movie</button></a>
        </div>

        <div class="seat-container">
            <p>All eyes this way please!</p>
            <div class="screen"></div>
            <div class="seats">
                <div class="row">
                    <div class="seat" id="A1">A1</div>
                    <div class="seat" id="A2">A2</div>
                    <div class="seat" id="A3">A3</div>
                    <div class="seat" id="A4">A4</div>
                    <div class="seat" id="A5">A5</div>
                    <div class="seat" id="A6">A6</div>
                    <div class="seat" id="A7">A7</div>
                    <div class="seat" id="A8">A8</div>
                </div>

                <div class="row">
                    <div class="seat" id="B1">B1</div>
                    <div class="seat" id="B2">B2</div>
                    <div class="seat" id="B3">B3</div>
                    <div class="seat" id="B4">B4</div>
                    <div class="seat" id="B5">B5</div>
                    <div class="seat" id="B6">B6</div>
                    <div class="seat" id="B7">B7</div>
                    <div class="seat" id="B8">B8</div>
                </div>

                <div class="row">
                    <div class="seat" id="C1">C1</div>
                    <div class="seat" id="C2">C2</div>
                    <div class="seat" id="C3">C3</div>
                    <div class="seat" id="C4">C4</div>
                    <div class="seat" id="C5">C5</div>
                    <div class="seat" id="C6">C6</div>
                    <div class="seat" id="C7">C7</div>
                    <div class="seat" id="C8">C8</div>
                </div>

                <div class="row">
                    <div class="seat" id="D1">D1</div>
                    <div class="seat" id="D2">D2</div>
                    <div class="seat" id="D3">D3</div>
                    <div class="seat" id="D4">D4</div>
                    <div class="seat" id="D5">D5</div>
                    <div class="seat" id="D6">D6</div>
                    <div class="seat" id="D7">D7</div>
                    <div class="seat" id="D8">D8</div>
                </div>

                <div class="row">
                    <div class="seat" id="E1">E1</div>
                    <div class="seat" id="E2">E2</div>
                    <div class="seat" id="E3">E3</div>
                    <div class="seat" id="E4">E4</div>
                    <div class="seat" id="E5">E5</div>
                    <div class="seat" id="E6">E6</div>
                    <div class="seat" id="E7">E7</div>
                    <div class="seat" id="E8">E8</div>
                </div>

                <div class="row">
                    <div class="seat" id="F1">F1</div>
                    <div class="seat" id="F2">F2</div>
                    <div class="seat" id="F3">F3</div>
                    <div class="seat" id="F4">F4</div>
                    <div class="seat" id="F5">F5</div>
                    <div class="seat" id="F6">F6</div>
                    <div class="seat" id="F7">F7</div>
                    <div class="seat" id="F8">F8</div>
                </div>
            </div>
        </div>
        <div class="availability">
            <div class="available">
                <div class="seat-available"></div>
                <p>Available</p>
            </div>
            <div class="select">
                <div class="seat-selected"></div>
                <p>Selected</p>
            </div>
            <div class="reserve">
                <div class="seat-reserved"></div>
                <p>Reserved</p>
            </div>
        </div>
        <div class="total-btn">
            <div class="total">
                <p>Ticket Price : Rs.
                    <?php
                    if (isset($_POST['movie_id'])) {
                        $movie_id = $_POST['movie_id'];

                        $queryPrice = "SELECT ticket_price FROM movies WHERE movie_id = $movie_id";
                        $resultPrice = mysqli_query($connection, $queryPrice);
                    }
                    if (mysqli_num_rows($resultPrice) > 0) {
                        $row = mysqli_fetch_assoc($resultPrice);
                        $ticketPrice = $row['ticket_price'];

                        echo "<span id = 'ticketPrice'>" . $ticketPrice . ".00</span>";
                        // Echo the ticket price as a JavaScript variable

                    }

                    mysqli_close($connection);
                    ?>
                    <script>
                        var ticketPrice = <?php echo json_encode($ticketPrice); ?>;
                    </script>
                </p>
                <p class="count">No. seats : <span id="count">0</span></p>
                <p>Total : Rs. <span id="total">0</span>.00</p>
            </div>
            <div class="proceed-btn">
                <a href="confirm.html"><button>Proceed</button></a>
            </div>
        </div>
    </div>
    <script src="booking.js"></script>
</body>

</html>