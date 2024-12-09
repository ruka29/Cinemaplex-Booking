<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showtimes | Reserve Cinema</title>
    <link rel="stylesheet" href="forms.css">
    <link rel="icon" type="image/x-icon" href="../images/favicon.jpg">
</head>
<body>

<?php

// Establish a MySQL connection
$connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");

// Verify the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve all movies from the database
$query = "SELECT * FROM bookings";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<h1>Bookings</h1>";
    echo "<table border='1'>";
    echo "<tr>
        <th>Booking ID</th>
        <th>User ID</th>
        <th>Movie ID</th>
        <th>Date</th>
        <th>Shotimes ID</th>
        <th>NO. seats</th>
        <th>Seat numbers</th>
        <th>Total</th>
        </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>{$row['booking_id']}</td>
        <td>{$row['user_id']}</td>
        <td>{$row['movie_id']}</td>
        <td>{$row['date']}</td>
        <td>{$row['showtimes_id']}</td>
        <td>{$row['no_seats']}</td>
        <td>{$row['seat_numbers']}</td>
        <td>{$row['total']}</td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "<h1>Bookings</h1>";
    echo "<table border='1'>";
    echo "<tr>
        <th>Booking ID</th>
        <th>User ID</th>
        <th>Movie ID</th>
        <th>Date</th>
        <th>Shotimes ID</th>
        <th>NO. seats</th>
        <th>Seat numbers</th>
 /html>
        </tr>
        <tr>
        <td colspan='8'>No movies found</td>
        </tr>";
}

// Close the database connection
mysqli_close($connection);
?>
</body>
</html>
