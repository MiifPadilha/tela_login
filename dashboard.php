<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location: index.php");
    exit();
}

$email= $_SESSION['email'];
?>