<?php
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $dynamicLocation = $_POST['dynamic_location'];
        $movie_id = $_POST['movie_id'];

        //establish a MySQL connection
        $connection = mysqli_connect("localhost", "root", "", "cinemaplex_booking_db");

        //verifying the connection
        if(!$connection){
            die("Connection failed : " . mysqli_connect_error());
        }

        $query = "SELECT id, username, password FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);

        // Check if a row was returned
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row["password"];

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                $_SESSION["user_id"] = $row["id"];
                header('Location: ../' . $dynamicLocation);
            } else {
                $loginError = "Invalid username or password.";
            }
        } else {
            $loginError = "Username not found";
        }

        mysqli_close($connection);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="icon" type="image/x-icon" href="../images/favicon.jpg">
    <title>Login | Cinemaplex Booking</title>
</head>

<body>

    <div class="container">

        <form class="login-form" action="login.php" method="post">
            <h1>Login</h1>
            <label for="username">Username </label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password </label>
            <input type="password" id="password" name="password" required>

            <?php
                if(isset($loginError)) : 
            ?>
            <p style="color: red;">
                <?php
                    echo $loginError; 
                ?>
            </p>
            <?php
                endif; 
            ?>

            <button type="submit" name="submit">Login</button>

            <p>Don't have an account? <a href="register.html" class="register">Register</a></p>
        </form>

    </div>
</body>

</html>