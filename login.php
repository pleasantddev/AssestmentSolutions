<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'login_system';

// Create database connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check db connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login user in
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT password FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        // Start session
        session_start();
        $_SESSION['email'] = $email;
        echo "Login successful!";
    } else {
        echo "Invalid credentials";
    }
}

?>
