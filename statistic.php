<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My sốp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card rounded-3">
                        <div class="card-body p-4">
                            <h4 class="text-center my-3 pb-3">Statistics</h4>
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
                                        <th scope="col">Publisher Name</th>
                                        <th scope="col">Count of Books</th>
                                        <th scope="col">Average Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $host = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $database = "midterm";

                                    $connection = new mysqli($host, $username, $password, $database);

                                    if ($connection->connect_error) {
                                        die("Connection failed: " . $connection->connect_error);
                                    }

                                    // Hàm để hiển thị thống kê sách theo nhà xuất bản
                                    function getBooksStatisticsByPublisher($connection)
                                    {
                                        $sql = "SELECT p.publisher_name, COUNT(b.book_id) AS book_count, AVG(b.book_price) AS avg_price
                                                FROM publisher p
                                                LEFT JOIN books b ON p.publisherid = b.publisherid
                                                GROUP BY p.publisher_name";

                                        $result = $connection->query($sql);

                                        if ($result) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>{$row['publisher_name']}</td>";
                                                echo "<td>{$row['book_count']}</td>";
                                                echo "<td>{$row['avg_price']}</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "Error in the database query: " . $connection->error;
                                        }
                                    }

                                    getBooksStatisticsByPublisher($connection);

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
</body>

</html>