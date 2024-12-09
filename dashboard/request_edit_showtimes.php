<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Showtimes | Cinemaplex Booking</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.jpg">
    <link rel="stylesheet" href="forms.css">
</head>

<body>


    <form action="edit_showtimes.php" method="post">
        <h1>Edit Showtimes</h1>
        <label for="showtime">Select a Showtime</label>
        <select name="showtimes_id" required>
            <option value="">Select showtime</option>

            <?php

            //establish a MySQL connection

            $connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");

            //verifying the connection
            if (!$connection) {
                die("Connection failed : " . mysqli_connect_error());
            }

            //retrieve the list of users from the database
            $query = "SELECT showtimes_id, time, location FROM showtimes";
            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value = '{$row['showtimes_id']}'>
                {$row['time']}
                {$row['location']}
                </option>";
                }
            }


            mysqli_close($connection);
            ?>

        </select>

        <label for="first_name">Time : </label>
        <input type="text" name="time" required>

        <label for="last_name">Location : </label>
        <input type="text" name="location" required>

        <input type="submit" value="Edit Showtime">

    </form>

</body>

</html>