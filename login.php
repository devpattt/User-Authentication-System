<?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
<?php
// Include the database connection
require 'includes/db_connect.php';
// Include session management
require 'includes/session.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username_or_email = trim($_POST['username_or_email']);
    $password = trim($_POST['password']);

    // Prepare the SQL statement to find the user
    $sql = "SELECT id, username, password_hash FROM users WHERE username = ? OR email = ? LIMIT 1";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $username_or_email, $username_or_email);
        $stmt->execute();
        $stmt->store_result();

        // Check if a user was found
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $username, $password_hash);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $password_hash)) {
                // Store user data in session
                session_start();
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;

                // Redirect to the dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Invalid credentials";
            }
        } else {
            echo "Invalid credentials";
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/validation.js"></script>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="POST" onsubmit="return validateLoginForm();">
        <label for="username_or_email">Username or Email:</label>
        <input type="text" id="username_or_email" name="username_or_email" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        
        <button type="submit">Login</button>
    </form>
</body>
</html>
