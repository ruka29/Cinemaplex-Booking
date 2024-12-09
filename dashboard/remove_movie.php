<?php
// Establish a MySQL connection
$connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if a movie ID is provided via POST
if (isset($_POST['movie_id'])) {
    $movie_id = $_POST['movie_id'];

    // Delete the movie from the database
    $queryCast = "DELETE FROM cast WHERE movie_id = $movie_id";
    $queryMovieDetails = "DELETE FROM movie_details WHERE movie_id = $movie_id";
    $query = "DELETE FROM movies WHERE movie_id = $movie_id";

    if (mysqli_query($connection, $queryCast) && mysqli_query($connection, $queryMovieDetails) && mysqli_query($connection, $query)) {
        echo "Movie deleted successfully.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }
} else {
    // If no movie ID is provided, display the deletion form
    echo file_get_contents('request_delete_movie.php');
}

// Close the database connection
mysqli_close($connection);
?>