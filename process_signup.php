<?php
require 'db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Debugging
    echo "Email: $email <br>";
    echo "Password: $password <br>";

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);

            if ($stmt->fetch()) {
                echo "Email is already registered. Please log in.";
            } else {
                $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
                if ($stmt->execute(['email' => $email, 'password' => $hashedPassword])) {
                    echo "Signup successful! You can now log in.";
                } else {
                    echo "Failed to sign up.";
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid email address.";
    }
}
?>
