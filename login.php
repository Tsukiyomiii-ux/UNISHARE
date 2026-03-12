<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "campus_rental");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // // Debug: Show what's being received
    // echo "<pre style='background:#f0f0f0; padding:10px;'>";
    // echo "=== DEBUG INFO ===\n";
    // echo "Email Input: '" . $email . "'\n";
    // echo "Password Input: '" . $password . "'\n";
    // echo "Email Length: " . strlen($email) . "\n";
    // echo "Password Length: " . strlen($password) . "\n";
    // echo "==================\n\n";

    // Validate inputs
    if (empty($email) || empty($password)) {
        echo "All fields are required";
        exit;
    }

    // Prepare SQL query
    $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        echo "=== USER DATA FROM DB ===\n";
        echo "Email: '" . $user['email'] . "'\n";
        echo "Email Length: " . strlen($user['email']) . "\n";
        echo "Password Hash: " . substr($user['password'], 0, 30) . "...\n";
        echo "=========================\n\n";

        // Verify password
        $verifyResult = password_verify($password, $user['password']);
        
        echo "=== PASSWORD VERIFICATION ===\n";
        echo "Input Password: '" . $password . "'\n";
        echo "Hash from DB: " . $user['password'] . "\n";
        echo "Verification Result: " . ($verifyResult ? "SUCCESS ✅" : "FAILED ❌") . "\n";
        echo "=============================\n\n";

        if ($verifyResult) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            echo "Login successful! <a href='dashboard.php'>Go to Dashboard</a>";
        } else {
            echo "Invalid login";
        }
    } else {
        echo "User not found in database";
    }

    $stmt->close();
} else {
    echo "Form not submitted via POST";
}

$conn->close();
?>