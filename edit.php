<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "midterm";

// Create a database connection
$connection = new mysqli($host, $username, $password, $database);

$errorMessage = "";
$successMessage = "";

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the client
    if (!isset($_GET["book_id"])) {
        header("location: /index.php");
        exit;
    }
    $id = $_GET["book_id"];

    $stmt = $connection->prepare("SELECT book_id, book_title, book_author, book_image, book_descr, book_price, publisherid FROM books WHERE book_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        $errorMessage = "Error in the database query: " . $connection->error;
    } else {
        $row = $result->fetch_assoc();
        if (!$row) {
            header("location: /index.php");
            exit;
        }
        $book_id = $row["book_id"];
        $book_title = $row["book_title"];
        $book_author = $row["book_author"];
        $book_image = $row["book_image"];
        $book_descr = $row["book_descr"];
        $book_price = $row["book_price"];
        $publisherid = $row["publisherid"];
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POST method: Update the data of the client
    $id = $_POST["id"];
    $book_title = $_POST["BookTitle"];
    $book_author = $_POST["BookAuthor"];
    $book_image = $_POST["Image"];
    $book_descr = $_POST["Description"];
    $book_price = $_POST["Price"];
    $publisherid = $_POST["publisherid"];

    if (empty($book_title) || empty($book_author)) {
        $errorMessage = "All the fields are required";
    } else {
        $stmt = $connection->prepare("UPDATE books SET book_title = ?, book_author = ?, book_image = ?, book_descr = ?, book_price = ?,publisherid=? WHERE book_id = ?");
        $stmt->bind_param("ssssdii", $book_title, $book_author, $book_image, $book_descr, $book_price, $publisherid, $id);

        if ($stmt->execute()) {
            $successMessage = "Book updated correctly";
            $stmt->close();
            header("location: /index.php");
            exit;
        } else {
            $errorMessage = "Error updating the book: " . $stmt->error;
        }
    }
}

$connection->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title</title>
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
                <label class="col-sm-3 col-form-label">BookTitle</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="BookTitle" value="<?php echo $book_title; ?>">
                </div>
            </div>
            <!-- Add any other form fields here -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">BookAuthor</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="BookAuthor" value="<?php echo $book_author; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Image</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Image" value="<?php echo $book_image; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Description" value="<?php echo $book_descr; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Price" value="<?php echo $book_price; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Publisherid</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="publisherid" value="<?php echo $publisherid; ?>">
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
                    <a class="btn btn-outline-primary" href="/index.php" role="button">Cancel</a>
                </div>
        </form>
    </div>
</body>

</html>