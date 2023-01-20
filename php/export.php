<?php
if (isset($_POST["export"])) {
// Connect to the database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "product db";
$tablename = "product";
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the data from the table
$query = "SELECT code,label,type FROM $tablename";
$result = $conn->query($query);

// Create a file pointer
$fp = fopen("export.csv", "w");

// Write the table headers to the CSV file
fputcsv($fp, array("code", "label", "type"));

// Write the table data to the CSV file
while($row = $result->fetch_assoc()) {
    fputcsv($fp, $row);
}

// Close the file pointer
fclose($fp);

// Download the CSV file
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=export.csv");
header("Pragma: no-cache");
header("Expires: 0");
readfile("export.csv");

// Close the database connection
$conn->close();

}
?>
