<?php
session_start();

if (!isset($_SESSION['admin_id'])){
    header("Location: login/login.html");  
} else{
    header("Location: dashboard.html");
}
?>

