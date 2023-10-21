<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "giuaki";

// Create a database connection
$connection = new mysqli($host, $username, $password, $database);

$CourseID = '';
$StudentID = '';
$Grade = '';

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $CourseID = $_POST["CourseID"];
    $StudentID = $_POST["StudentID"];
    $Grade = $_POST["Grade"];
    do {
        if (empty($CourseID) || empty($StudentID) || empty($Grade)) {
            $errorMessage = "All the fields are required";
            break;
        }
        $sql = "INSERT INTO Enrollment (CourseID, StudentID, Grade)" . "VALUES 
        ('$CourseID', '$StudentID', '$Grade')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
            // Handle the error or display it as needed
        }

        $CourseID = '';
        $StudentID = '';
        $Grade = '';

        $successMessage = "Client added successfully";
        header("location: /index.php");
    } while (false);
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
        <h2>New</h2>
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
                    | <a class="btn btn-outline-primary" href="/index.php" role="button">Cancel</a>
                </div>
        </form>
    </div>

</body>

</html>