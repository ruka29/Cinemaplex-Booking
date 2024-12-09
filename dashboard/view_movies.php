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
$query = "SELECT * FROM movies";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<h1>Movies</h1>";
    echo "<table border='1'>";
    echo "<tr>
        <th>ID</th>
        <th>Movie name</th>
        <th>Ticket Price</th>
        <th>Trailer Link</th>
        <th>Showtime ID</th>
        </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>{$row['movie_id']}</td>
        <td>{$row['movie_name']}</td>
        <td>{$row['ticket_price']}</td>
        <td>{$row['trailer_link']}</td>
        <td>{$row['showtimes_id']}</td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "<h1>Movies</h1>";
    echo "<table border='1'>";
    echo "<tr>
        <th>ID</th>
        <th>Movie name</th>
        <th>Ticket Price</th>
        <th>Trailer Link</th>
        <th>Showtime ID</th>
        </tr>
        <tr>
        <td colspan='4'>No movies found</td>
        </tr>";
}

// Close the database connection
mysqli_close($connection);

?>
</body>
</html>