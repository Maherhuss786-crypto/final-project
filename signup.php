<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $email = $_POST['email'];
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $agreed_to_terms = isset($_POST['terms']) ? 1 : 0;

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert into database
        $sql = "INSERT INTO users (username, password, email, first_name, last_name, agreed_to_terms) 
                VALUES ('$username', '$hashed_password', '$email', '$first_name', '$last_name', '$agreed_to_terms')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Signup successful!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GTTI Signup Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="signup-box">
            <div class="header">
                <h2>Government Technical Training Institute (GTTI)</h2>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTG4tXOtQH1F_rIzlAhaP7ACgDnT0gpyUCmUw&s" height="50" width="50" alt="GTTI Logo">
            </div>

            <h3>Signup</h3>
            <p>Already have an account? <a href="login.php">Login</a>.</p>
            <hr>

            <form action="signup.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>

                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first-name" required>

                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last-name" required>

                <div class="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I have read the <a href="#">Terms of Service</a>.</label>
                </div>

                <button type="submit" class="signup-btn">Signup</button>
            </form>
        </div>
    </div>
</body>
</html>