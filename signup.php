<?php
require 'connection.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($username) && !empty($email) && !empty($password) && !empty($confirm_password)) {
        if ($password === $confirm_password) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit;
            } else {
                $error = "Username or email already exists.";
            }
        } else {
            $error = "Passwords do not match.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Royal Mobile Shop</title>
    <style>
        /* style/style.css */

/* General Reset */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Signup Container */
.signup-container {
    background-color: #ffffff;
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

.signup-container h2 {
    font-size: 24px;
    color: #333333;
    margin-bottom: 20px;
}

/* Input Fields */
.signup-container input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #dddddd;
    border-radius: 5px;
    font-size: 14px;
    box-sizing: border-box;
}

/* Submit Button */
.signup-container button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    border: none;
    color: #ffffff;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.signup-container button:hover {
    background-color: #0056b3;
}

/* Error Message */
.error {
    color: #ff0000;
    font-size: 14px;
    margin-bottom: 15px;
    text-align: left;
}

/* Link to Login */
.signup-container p {
    margin-top: 10px;
    font-size: 14px;
}

.signup-container p a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

.signup-container p a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="signup.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Log in</a></p>
    </div>
</body>
</html>
