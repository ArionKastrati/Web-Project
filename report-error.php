<?php
// report-error.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the error details from the AJAX request
    $errorDescription = $_POST['errorDescription'];
    $userEmail = $_POST['userEmail'];

    // Database configuration
    $dbServerName = "localhost:3307";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "web2-database";

    // Create a connection to the database
    $conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement to insert the error details
    $sql = "INSERT INTO error_reports (error_description, user_email) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $errorDescription, $userEmail);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Return a success response
        http_response_code(200);
        echo 'Error reported successfully';
    } else {
        // Return an error response
        http_response_code(500); // Internal Server Error
        echo 'Error reporting error';
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // Return an error response if accessed directly
    http_response_code(403); // Forbidden
    echo 'Forbidden';
}
?>
