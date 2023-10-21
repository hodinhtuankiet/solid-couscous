<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "giuaki";

// Create a database connection
$connection = new mysqli($host, $username, $password, $database);

$CourseID = "";
$StudentID = "";
$Grade = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the client
    if (!isset($_GET["EnrollmentID"])) {
        header("location: /index.php");
        exit;
    }
    $id = $_GET["EnrollmentID"];

    $sql = "SELECT * FROM Enrollment WHERE EnrollmentID = $id";
    $result = $connection->query($sql);

    if (!$result) {
        $errorMessage = "Error in the database query: " . $connection->error;
    } else {
        $row = $result->fetch_assoc();
        if (!$row) {
            header("location: /index.php");
            exit;
        }
        $CourseID = $row["CourseID"];
        $StudentID = $row["StudentID"];
        $Grade = $row["Grade"];
    }
} else {
    // POST method: Update the data of the client
    $id = $_POST["id"];
    $CourseID = $_POST["CourseID"];
    $StudentID = $_POST["StudentID"];
    $Grade = $_POST["Grade"];

    if (empty($CourseID) || empty($StudentID) || empty($Grade)) {
        $errorMessage = "All the fields are required";
    } else {
        $sql = "UPDATE Enrollment 
        SET CourseID = '$CourseID', StudentID = '$StudentID', Grade = '$Grade'
        WHERE EnrollmentID = $id";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            $successMessage = "Client updated correctly";
            header("location: /index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my sốp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-betal/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Edit</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">CourseID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="CourseID" value="<?php echo $CourseID; ?>">
                </div>
            </div>
            <!-- Add any other form fields here -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">StudentID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="StudentID" value="<?php echo $StudentID; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Grade</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Grade" value="<?php echo $Grade; ?>">
                </div>
            </div>
            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
            <!-- Add more fields as needed -->
            <div class="row">
                <div class="col-sm-6 offset-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    | <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">Cancel</a>
                </div>
        </form>
    </div>

</body>

</html>