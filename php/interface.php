<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Open Sans', sans-serif;
    }
    .file-import-box {
    display: flex;
    align-items :center ;
 }

    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    .table {
        border-collapse: collapse;
        width: 100%;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        text-align: left;
        border: 1px solid #dee2e6;
    }

    .btn-danger {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        color: #fff;
        background-color: #c82333;
        border-color: #bd2130;
    }

    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #0069d9;
        border-color: #0062cc;
    }
</style>

<body>
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title">Welcome to the Interface</h3>

                        <form action="import.php" method="post" enctype="multipart/form-data">
                            <div class="form-group file-import-box">
                                <input type="file" name="file" id="file" class="form-control-file">
                                <input type="submit" value="Import" name="import" class="btn btn-primary">
                            </div>
                        </form>



                        <form action="export.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="submit" value="Export" name="export" class="btn btn-primary">
                            </div>
                        </form>
                        <br>

                        <table border="1" class="table">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Label</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php



                                try {
                                    $host = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "product db";
                                    $tablename = "product";

                                    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $query = "SELECT code,label,type FROM $tablename";
                                    $stmt = $conn->prepare($query);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();

                                    foreach ($result as $row) {
                                        echo "<tr>";
                                        echo "<td>" . $row["code"] . "</td>";
                                        echo "<td>" . $row["label"] . "</td>";
                                        echo "<td>" . $row["type"] . "</td>";
                                        echo "</tr>";
                                    }
                                } catch (PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                                $conn = null;
                                ?>


                            </tbody>
                        </table>
                        <form action="delete.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="submit" class="btn btn-danger" name="delete" value="Delete" />
                            </div>
                        </form>

                        <form action="update.php" method="post" enctype="multipart/form-data">
                            <div class="form-group  file-import-box">
                                <input type="file" name="file" id="file" class="form-control-file">
                                <input type="submit" class="btn btn-warning" name="update" value="update" onclick="return confirm('Are you sure you want to update the records?');"/>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</body>