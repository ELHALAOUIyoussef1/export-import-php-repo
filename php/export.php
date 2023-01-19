<?php
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="export.csv"');

$host = "localhost";
$username = "root";
$password = "";
$dbname = "product db";
$tablename = "product";
if(isset($_POST["export"])) {
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT code,label,type FROM $tablename";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
    
        $file = fopen("php://output", "w");
        foreach ($result as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
        echo "Data exported successfully.";
        
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    }
?>
