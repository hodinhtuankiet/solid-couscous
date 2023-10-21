<?php
if (isset($_GET["EnrollmentID"])) {
    $id = $_GET["EnrollmentID"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "giuaki";
    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);
    
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    
    // Use prepared statements to prevent SQL injection
    $sql = "DELETE FROM Enrollment WHERE EnrollmentID=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    
    // Close the database connection
    $stmt->close();
    $connection->close();
}

header("location: /index.php");
exit;
