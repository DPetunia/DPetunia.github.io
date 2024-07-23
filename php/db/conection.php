<?php
    // Create a database connection
    $conn = mysqli_connect("localhost", "root", "");
            
    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
            
    // Create the database if it doesn't exist
    $createconnSQL = "CREATE DATABASE IF NOT EXISTS MadrasahAnnur";
            
    if ($conn->query($createconnSQL) === false) {
        die("Error creating database: " . $conn->error);
    }
            
    // Close the initial connection
    mysqli_close($conn);
    
    // Create a connection to the database
    $conn = new mysqli("localhost", "root", "", "MadrasahAnnur");

    // Check for a connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>