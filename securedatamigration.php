<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'old_database';
$new_db_name = 'new_database';

// Create connections
$old_conn = new mysqli($db_host, $db_username, $db_password, $db_name);
$new_conn = new mysqli($db_host, $db_username, $db_password, $new_db_name);

// Check connections
if ($old_conn->connect_error) {
    die("Old database connection failed: " . $old_conn->connect_error);
}
if ($new_conn->connect_error) {
    die("New database connection failed: " . $new_conn->connect_error);
}

// Migrate data
$query = "SELECT * FROM users";
$result = $old_conn->query($query);

while ($row = $result->fetch_assoc()) {
    $email = $row['email'];
    $password = $row['password'];

    $query = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $new_conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
}

echo "Data migrated successfully";

$old_conn->close();
$new_conn->close();

?>

