<?php

    // Your database connection parameters
    $servername = "localhost";
    $username = "siyad";
    $password = "123456";
    $dbname = "phpform";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

         // Check connection
         if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
   
?>
