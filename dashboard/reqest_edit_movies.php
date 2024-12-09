<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movies | Cinemaplex Booking</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.jpg">
    <link rel="stylesheet" href="forms.css">
</head>

<body>


    <form action="edit_movies.php" method="post">
        <h1>Edit Movies</h1>
        <label for="movie">Select a Movie</label>
        <select name="movie_id" required>
            <option value="">Select Movie</option>

            <?php

            //establish a MySQL connection

            $connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");

            //verifying the connection
            if (!$connection) {
                die("Connection failed : " . mysqli_connect_error());
            }

            //retrieve the list of users from the database
            $query = "SELECT movie_id, movie_name FROM movies";
            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value = '{$row['movie_id']}'>
                {$row['movie_name']}
                </option>";
                }
            }


            mysqli_close($connection);
            ?>

        </select>

        <label for="first_name">Movie Name : </label>
        <input type="text" name="movie_name" required>

        <label for="last_name">Ticket Price : </label>
        <input type="text" name="ticket_price" required>

        <label for="email">Trailer Link : </label>
        <input type="text" name="trailer_link" required>

        <label for="password">Showtime ID : </label>
        <input type="number" name="showtimes_id" required>

        <input type="submit" value="Edit Movie">

    </form>

</body>

</html>