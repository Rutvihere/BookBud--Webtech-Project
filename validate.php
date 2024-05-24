<!DOCTYPE html>
<html>
<head>
    <title>Login Validation</title>
    <link rel='stylesheet' type='text/css' href='validat.css'/>
</head>
<body>
    <img src="logo.png" alt="Bookbud Logo" class="logo">
    <h3>Login</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Username:<br><input type="text" name="login_username" placeholder="Username"><br><br>
        Password:<br><input type="password" name="login_password" placeholder="Password"><br><br>
        <input type="submit" name="login" value="Log In">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
        $servername = "localhost";
        $username = "root";
        $password = ""; // Use an empty password if you haven't set any
        $dbname = "swapbook";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get form data
        $login_username = $_POST['login_username'];
        $login_password = $_POST['login_password'];

        // Query the database for user credentials
        $sql = "SELECT * FROM signup WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $login_username, $login_password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            echo "Login successful!"; // Redirect or display a success message
            // Example: header("Location: user_dashboard.php");
        } else {
            echo "Invalid username or password";
        }

        // Close the connection
        $conn->close();
    }
    ?>
</body>
</html>
