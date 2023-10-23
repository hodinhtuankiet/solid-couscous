<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuan Kiet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card rounded-5">
                        <div class="card-body p-1">
                            <h4 class="text-center my-3 pb-3">Giua Ki</h4>
                            <form method="post" action="search.php" class="d-flex justify-content-center align-items-center mb-3 pb-2">
                                <div class="col-8">
                                    <input type="text" placeholder="Search " name="search" class="form-control" id="search">
                                </div> </br>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary" name="submit">Search</button>
                                </div>
                            </form>
                            <div class="col-12">
                                <a href="/create.php" class="btn btn-warning">Create new</a>
                            </div> </br>
                            <div class="col-12">
                                <a href="/statistic.php" class="btn btn-primary">Statistics</a>
                            </div>
                            </form>
                            <table class="table mb-4">
                                <thead>
                                    <tr>
                                        <th scope="col">BookID</th>
                                        <th scope="col">BookTitle</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">ImageBook</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">BookPrice</th>
                                        <th scope="col">Publisherid</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $database = "midterm";

                                    // Create connection
                                    $connection = new mysqli($servername, $username, $password, $database);

                                    // Check connection
                                    if ($connection->connect_error) {
                                        die("Connection failed: " . $connection->connect_error);
                                    }
                                    $sql = "SELECT * FROM books";
                                    $result = $connection->query($sql);

                                    if (!$result) {
                                        die("Invalid query: " . $connection->error);
                                    }

                                    while ($todo = $result->fetch_assoc()) {
                                        echo
                                        "<tr>
                                        <td>{$todo['book_id']}</td>
                                        <td>{$todo['book_title']}</td>
                                        <td>{$todo['book_author']}</td>
                                        <td><img src='{$todo['book_image']}' alt='{$todo['book_title']}' width='100'></td>
                                        <td>{$todo['book_descr']}</td>
                                        <td>{$todo['book_price']}</td>
                                        <td>{$todo['publisherid']}</td>
                                        <td>
                                        <a class='btn btn-danger btn-sm' href='/delete.php?book_id=$todo[book_id]?>'>Delete</a>
                                        <a class='btn btn-primary btn-sm' href='/edit.php?book_id=$todo[book_id]'>Edit</a>
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
</body>

</html>