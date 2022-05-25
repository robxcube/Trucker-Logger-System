<?php
    $conn = new PDO('mysql:host=localhost;dbname=truckingdb', 'root', '');

    if(!$conn) {
        die("Connection failed: ");
    } else "Connected Succesfully";
?>