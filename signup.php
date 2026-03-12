<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "campus_rental");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // DEBUG: Show what's being received
    echo "<pre>";
    echo "POST Data:\n";
    print_r($_POST);
    echo "</pre>";
    
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';

    echo "<pre>";
    echo "Email: " . $email . "\n";
    echo "Password: " . $password . "\n";
    echo "Confirm Password: " . $confirmPassword . "\n";
    echo "</pre>";

    // Validate inputs
    if (empty($email) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required";
        exit;
    }

    if ($password !== $confirmPassword) {
        echo "Passwords do not match";
        exit;
    }

    if (strlen($password) < 6) {
        echo "Password must be at least 6 characters";
        exit;
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email already registered";
        exit;
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "Registration successful! <a href='login.html'>Login here</a>";
    } else {
        echo "Registration failed: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Form not submitted via POST";
}

$conn->close();
?>