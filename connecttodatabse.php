<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'login_system';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform database operations
$query = "SELECT * FROM users";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    echo $row['email'] . "<br>";
}

$conn->close();

?>

