<?php
    // Port 4444 - 3306 ocuped on local
    $servername = "localhost:4444";
    $dbusername = "blogAdmin";
    $dbPassword = "Lp1V9tldnQc/F*DV";
    $dbname = "blog";

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbPassword, $dbname);
    //Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connection_error);
    }
?>