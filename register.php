<?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
<?php
// Include the database connection
require 'includes/db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Hash the password
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the SQL statement to insert the user
    $sql = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";

    // Use prepared statements to prevent SQL injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $username, $email, $password_hash);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "Registration successful!";
            // Redirect or further process
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/validation.js"></script>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="POST" onsubmit="return validateForm();">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        
        <button type="submit">Register</button>
    </form>
</body>
</html>
