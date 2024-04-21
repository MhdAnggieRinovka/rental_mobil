<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "db_rentalCar";

    $conn = mysqli_connect($hostname,$username,$password,$database);

    if($conn->connect_error)
    {
        die("Connection Failed: ". $conn->connect_error);
    }
?>