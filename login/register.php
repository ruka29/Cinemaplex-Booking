<?php
//establish a MySQL connection

$connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");

//verifying the connection
if(!$connection){
    die("Connection failed : " . mysqli_connect_error());
}

//retrieve user input from form
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//Insert data into the database
$query = "INSERT INTO users (first_name, last_name, username, email, password) VALUES
('$first_name', '$last_name', '$username', '$email', '$password')";

//check whether the inserting data into the db is correct or not
if(mysqli_query($connection, $query)){
    header('Location: login.html'); //redirect to signin page
} else{
    echo 'Error: ' . $query . "<br>" . mysqli_error($connection);
}

//colse the databse connection
mysqli_close($connection);
?>