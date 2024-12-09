<?php
// Establish a MySQL connection
$connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");

// Verify the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve user input from the form
$movie_name = $_POST['movie_name'];
$ticket_price = $_POST['ticket_price'];
$trailer_link = $_POST['trailer_link'];
$showtime_id = $_POST['showtime_id']; // Correct the variable name here

$target_dir = "upload_images/"; // Directory where you want to store uploaded images
$poster_path = $target_dir . basename($_FILES['poster']['name']);
$landscape_path = $target_dir . basename($_FILES['landscape_img']['name']);

if (move_uploaded_file($_FILES['poster']['tmp_name'], $poster_path) && move_uploaded_file($_FILES['landscape_img']['tmp_name'], $landscape_path)) {
    
    $query = "INSERT INTO movies (movie_name, ticket_price, trailer_link, poster_path, landscape_path, showtimes_id) VALUES
    ('$movie_name', '$ticket_price', '$trailer_link', '$poster_path', '$landscape_path', '$showtime_id')";

    if (mysqli_query($connection, $query)) {
        echo 'Movie table updated.';

        $queryMovieId = "SELECT movie_id FROM movies WHERE movie_name = '$movie_name'";
        $resultMovieId = mysqli_query($connection, $queryMovieId);

        if (mysqli_num_rows($resultMovieId) > 0) {
            $row = mysqli_fetch_assoc($resultMovieId);
            $movie_id = $row['movie_id'];
            $genres = $_POST['genres'];
            $duration = $_POST['duration'];
            $director = $_POST['director'];
            $producer = $_POST['producer'];
            $writer = $_POST['writer'];
        }

        $queryMovieDetails = "INSERT INTO movie_details (movie_id, genres, duration, director, producer, writer) VALUES
        ('$movie_id', '$genres', '$duration', '$director', '$producer', '$writer')";

        if(mysqli_query($connection, $queryMovieDetails)){
            echo '<br>Movie details inserted into database.';

            $actor_1 = $_POST['actor1'];
            $actor_1_character = $_POST['actor1_character'];

            $actor_2 = $_POST['actor2'];
            $actor_2_character = $_POST['actor2_character'];

            $actor_3 = $_POST['actor3'];
            $actor_3_character = $_POST['actor3_character'];

            $queryActor1 = "INSERT INTO cast (movie_id, actor_name, character_name) VALUES
            ('$movie_id', '$actor_1', '$actor_1_character')";

            $queryActor2 = "INSERT INTO cast (movie_id, actor_name, character_name) VALUES
            ('$movie_id', '$actor_2', '$actor_2_character')";

            $queryActor3 = "INSERT INTO cast (movie_id, actor_name, character_name) VALUES
            ('$movie_id', '$actor_3', '$actor_3_character')";

            if(mysqli_query($connection, $queryActor1) && mysqli_query($connection, $queryActor2) && mysqli_query($connection, $queryActor3)){
                echo '<br>Casting details inserted into database.';
            }
        }
    } else {
        echo 'Error: ' . $query . "<br>" . mysqli_error($connection);
    }
} else {
    echo 'Sorry, there was an error uploading the image.';
}

// Close the database connection
mysqli_close($connection);
?>