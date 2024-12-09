<?php
if(isset($_POST['dynamic_location'])){
    $dynamicLocation = $_POST['dynamic_location'];
}else{
    if(isset($_SESSION['dynamic_location'])){
        $dynamicLocation = $_SESSION['dynamic_location'];
    }
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

        <form class="login-form" action="login_validation.php" method="post">
            <h1>LOGIN</h1>
            <label for="username">Username </label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password </label>
            <input type="password" id="password" name="password" required>

            <?php
            if(isset($dynamicLocation)){
              echo '<input type="hidden" name="dynamic_location" value="' . $dynamicLocation . '">';  
            }
            ?>

            <button type="submit" name="submit">LOGIN</button>

            <p>Don't have an account? <a href="register.html" class="register">Register</a></p>
        </form>

    </div>
</body>

</html>