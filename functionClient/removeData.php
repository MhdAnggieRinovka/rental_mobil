<?php
require '../service/database.php';
session_start();
    $ktp = $_GET['id'];
    $query = mysqli_query($conn,"DELETE FROM client where no_ktp = '$ktp'");
    $_SESSION['delete'] = true;
    header("Location: ../home.php");
    exit;
?>