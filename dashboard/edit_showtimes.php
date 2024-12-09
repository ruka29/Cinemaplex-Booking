<?php
// Establish a MySQL connection
$connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if a user ID is provided via POST
if (isset($_POST['showtimes_id'])) {
    $showtimes_id = $_POST['showtimes_id'];

    // Retrieve user data from the form
    $time = $_POST['time'];
    $location = $_POST['location'];

    // Update user data in the database
    $query = "UPDATE showtimes SET time = '$time', location = '$location' WHERE showtimes_id = $showtimes_id";

    if (mysqli_query($connection, $query)) {
        echo "User updated successfully.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }
} else {
    // If no user ID is provided, display the modification form
    echo file_get_contents('request_edit_showtimes.php');
}

// Close the database connection
mysqli_close($connection);
?>
