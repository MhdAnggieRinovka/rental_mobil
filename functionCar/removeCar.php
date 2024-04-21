<?php
require '../service/database.php';
session_start();
    $noKendaraan = $_GET['id'];
    $query = mysqli_query($conn,"DELETE FROM datamobil where noKendaraan = '$noKendaraan'");
    $_SESSION['delete'] = true;
    header("Location: ../carPage.php");
    exit;
?>