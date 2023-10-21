<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "giuaki";

// Tạo kết nối đến cơ sở dữ liệu
$connection = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($connection->connect_error) {
    die("Kết nối thất bại: " . $connection->connect_error);
}

if (isset($_POST['submit'])) {
    $search = $_POST['search'];

    // Sử dụng truy vấn SQL để tìm kiếm trong cơ sở dữ liệu
    $sql = "SELECT * FROM Enrollment WHERE CourseID LIKE '%$search%' OR StudentID LIKE '%$search%' OR Grade LIKE '%$search%'";
    $result = $connection->query($sql);

    if (!$result) {
        die("Truy vấn không hợp lệ: " . $connection->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<head>
    <!-- Các thẻ meta và tiêu đề của trang -->
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card rounded-3">
                        <div class="card-body p-4">
                            <h4 class="text-center my-3 pb-3">To Do App</h4>
                            <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-3 pb-2" method="POST" action="">
                                <div class="col-12">
                                    <div class="form-outline">
                                        <label class="form-label" for="form1">Search a task here</label>
                                        <input type="text" id="form1" class="form-control" name="search" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary" name="submit">Search</button>
                                </div>
                                <div class="col-12">
                                    <a href="/create.php" class="btn btn-warning">Create new</a>
                                </div>
                            </form>
                            <table class="table mb-4">
                                <thead>
                                    <tr>
                                        <th scope="col">EnrollmentID</th>
                                        <th scope="col">CourseID</th>
                                        <th scope="col">StudentID</th>
                                        <th scope="col">Grade</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($todo = $result->fetch_assoc()) {
                                        echo
                                        "<tr>
                                            <td>{$todo['EnrollmentID']}</td>
                                            <td>{$todo['CourseID']}</td>
                                            <td>{$todo['StudentID']}</td>
                                            <td>{$todo['Grade']}</td>
                                            <td>
                                                <a class='btn btn-danger btn-sm' href='/delete.php?EnrollmentID={$todo['EnrollmentID']}'>Delete</a>
                                                <a class='btn btn-primary btn-sm' href='/edit.php?EnrollmentID={$todo['EnrollmentID']}'>Edit</a>
                                            </td>
                                        </tr>";
                                    }
                                    $connection->close(); // Close the database connection when done.
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
</body>

</html>