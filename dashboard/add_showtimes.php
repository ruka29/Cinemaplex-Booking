<?php
//establish a MySQL connection
$connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");

//verifying the connection
if(!$connection){
    die("Connection failed : " . mysqli_connect_error());
}

//retrieve user input from form
$time = $_POST['time'];
$location = $_POST['location'];

//Insert data into the database
$query = "INSERT INTO showtimes (time, location) VALUES
('$time', '$location')";

//check whether the inserting data into the db is correct or not
if(mysqli_query($connection, $query)){
    echo 'Movie added successfully';
} else{
    echo 'Error: ' . $query . "<br>" . mysqli_error($connection);
}

//colse the databse connection
mysqli_close($connection);

?>