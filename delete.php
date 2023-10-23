<?php
if (isset($_GET["book_id"])) {
    $id = $_GET["book_id"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "midterm";
    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $sql = "DELETE FROM books WHERE book_id=?";
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
