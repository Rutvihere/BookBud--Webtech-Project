<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <link rel='stylesheet' type='text/css' href='sign.css'/>
    <script>
        function validateForm() {
            var username = document.forms["signinForm"]["username"].value;
            var password = document.forms["signinForm"]["password"].value;

            if (username === "" || password === "") {
                alert("Please fill in both username and password.");
                return false;
            }
        }
    </script>
</head>
<body>
    <img src="logo.png" alt="Swapit Logo" class="logo">
    <div class="textde">
        <h1>Sign In</h1>
        <form name="signinForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
            UserName:<br><input type="text" name="username" placeholder="Username"><br><br>
            Password:<br><input type="password" name="password" placeholder="Password"><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $conn = new mysqli("localhost", "root", "", "swapbook");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Handle form submission
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($username !== "" && $password !== "") {
                $sql = "SELECT * FROM signup WHERE username='$username'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    if ($user['password'] === $password) {
                        // User successfully authenticated
                        header("Location: userpage.html"); // Redirect to userpage.html
                        exit();
                    } else {
                        // Invalid password
                        echo "Invalid password.";
                    }
                } else {
                    // User not found
                    echo "User not found.";
                }
            } else {
                echo "Please fill in both username and password.";
            }

            $conn->close();
        }
    }
    ?>
</body>
</html>
