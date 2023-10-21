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
                            <h4 class="text-center my-3 pb-3">To Do App</h4>
                            <form method="post" action="search.php" class="d-flex justify-content-center align-items-center mb-3 pb-2">
                                <div class="col-8">
                                    <input type="text" placeholder="Search users" name="search" class="form-control" id="search">
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary" name="submit">Search</button>
                                </div>
                            </form>
                            <div class="col-12">
                                <a href="/create.php" class="btn btn-warning">Create new</a>
                            </div>
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
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $database = "giuaki";

                                    // Create connection
                                    $connection = new mysqli($servername, $username, $password, $database);

                                    // Check connection
                                    if ($connection->connect_error) {
                                        die("Connection failed: " . $connection->connect_error);
                                    }
                                    $sql = "SELECT * FROM enrollment";
                                    $result = $connection->query($sql);

                                    if (!$result) {
                                        die("Invalid query: " . $connection->error);
                                    }

                                    while ($todo = $result->fetch_assoc()) {
                                        echo
                                        "<tr>
                                        <td>{$todo['EnrollmentID']}</td>
                                        <td>{$todo['CourseID']}</td>
                                        <td>{$todo['StudentID']}</td>
                                        <td>{$todo['Grade']}</td>
                                        <td>
                                        <a class='btn btn-danger btn-sm' href='/delete.php?EnrollmentID=$todo[EnrollmentID]?>'>Delete</a>
                                        <a class='btn btn-primary btn-sm' href='/edit.php?EnrollmentID=$todo[EnrollmentID]'>Edit</a>
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