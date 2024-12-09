<?php
// Establish a MySQL connection
$connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if a user ID is provided via POST
if (isset($_POST['movie_id'])) {
    $movie_id = $_POST['movie_id'];

    // Retrieve user data from the form
    $movie_name = $_POST['movie_name'];
    $ticket_price = $_POST['ticket_price'];
    $trailer_link = $_POST['trailer_link'];
    $showtimes_id = $_POST['showtimes_id'];

    // Update user data in the database
    $query = "UPDATE movies SET movie_name = '$movie_name', ticket_price = '$ticket_price', trailer_link = '$trailer_link', showtimes_id = '$showtimes_id' WHERE movie_id = $movie_id";

    if (mysqli_query($connection, $query)) {
        echo "User updated successfully.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }
} else {
    // If no user ID is provided, display the modification form
    echo file_get_contents('request_edit_movies.php');
}

// Close the database connection
mysqli_close($connection);
?>
