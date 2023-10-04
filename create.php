<?php
$host = "your_database_host";
$username = "your_database_username";
$password = "your_database_password";
$database = "your_database_name";

// Create a database connection
$connection = new mysqli($host, $username, $password, $database);

// Check for a database connection error
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$name = '';
$email = '';
$phone = '';
$address = '';

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add new client to the database
        $sql = "INSERT INTO clients (name, email, phone, address) " .
            "VALUES ('$name', '$email', '$phone', '$address')";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $name = '';
        $email = '';
        $phone = '';
        $address = '';
        $successMessage = 'Added successfully';
        header("location:/index.php");
        exit;
    } while (false);
}

// Close the database connection when done
$connection->close();
?>

<!-- Rest of your HTML code remains the same -->