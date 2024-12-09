<!DOCTYPE html>
<html>

<head>
    <title>Delete Movie | Cinemaplex Booking</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.jpg">
    <link rel="stylesheet" href="forms.css">
</head>

<body>

    <form action="remove_movie.php" method="POST">
        <h1>Delete Movie</h1>
        <label for="movie">Select a Movie to Delete:</label>
        <select name="movie_id" required>
            <option value="">Select movie</option>

            <?php
            // Establish a MySQL connection
            $connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");

            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Retrieve the list of users from the database
            $query = "SELECT movie_id, movie_name FROM movies";
            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['movie_id']}'>{$row['movie_name']}</option>";
                }
            }

            // Close the database connection
            mysqli_close($connection);
            ?>

        </select>

        <input type="submit" value="Delete Movie">
    </form>
</body>

</html>