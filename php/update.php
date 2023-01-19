<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "product db";
    $tablename = "product";
    if (isset($_POST["update"])) {
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_FILES["file"]["tmp_name"])) {

            if (!is_uploaded_file($_FILES['file']['tmp_name'])) {

                echo "<script>alert('Please select a file to import.');window.location.replace('interface.php');</script>";
            } else {
                $file = fopen($_FILES["file"]["tmp_name"], "r");
                while (($data = fgetcsv($file)) !== FALSE) {
                    $query = "UPDATE $tablename set label= ? ,type=? where code=?";
                    $stmt = $conn->prepare($query);
                    $stmt->bindValue(1, $data[1], PDO::PARAM_STR);
                    $stmt->bindValue(2, $data[2], PDO::PARAM_STR);
                    $stmt->bindValue(3, $data[0], PDO::PARAM_STR);
                    $stmt->execute();
                }
                fclose($file);
                echo "<script>alert('updated successfully');window.location.replace('interface.php');</script>";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}

?>