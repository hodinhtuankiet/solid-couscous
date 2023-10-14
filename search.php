<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "crud";

// Tạo kết nối đến cơ sở dữ liệu
$connection = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($connection->connect_error) {
    die("Kết nối thất bại: " . $connection->connect_error);
}

if (isset($_POST['submit'])) {
    $search = $_POST['search'];

    // Sử dụng truy vấn SQL để tìm kiếm trong cơ sở dữ liệu
    $sql = "SELECT * FROM clients WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' OR address LIKE '%$search%'";
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
    <div class="container my-5">
        <h2>ToDo List</h2>
        <form method="post">
            <input type="text" placeholder="Search users" name="search">
            <button name="submit">Search</button>
        </form>
        <!-- Hiển thị kết quả tìm kiếm -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($result)) {
                    while ($row = $result->fetch_assoc()) {
                        echo
                        "<tr>
                            <td>$row[id]</td>
                            <td>$row[name]</td>
                            <td>$row[email]</td>
                            <td>$row[phone]</td>
                            <td>$row[address]</td>  
                            <td>$row[created_at]</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='/edit.php?id=$row[id]'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='/delete.php?id=$row[id]'>Delete</a>
                            </td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>