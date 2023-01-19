<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "product db";
$tablename = "product";
if (isset($_POST["delete"])) {
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "DELETE FROM $tablename";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        echo "<script>alert('All records deleted successfully');window.location.replace('interface.php');</script>";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>
