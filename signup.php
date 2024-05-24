<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel='stylesheet' type='text/css' href='signu.css'/>
    <script>
        function validateForm() {
            var firstName = document.forms["signupForm"]["firstname"].value;
            var lastName = document.forms["signupForm"]["lastname"].value;
            var age = document.forms["signupForm"]["age"].value;
            var mobileNo = document.forms["signupForm"]["mobileno"].value;
            var email = document.forms["signupForm"]["emailid"].value;
            var username = document.forms["signupForm"]["username"].value;
            var password = document.forms["signupForm"]["password"].value;

            if (firstName === "" || lastName === "" || age === "" || mobileNo === "" || email === "" || username === "" || password === "") {
                alert("Please fill in all fields");
                return false;
            }
        }
    </script>
</head>
<body>
    <img src="logo.png" alt="Bookbud Logo" class="logo">
    <div class="divleft">
        <h1>Sign Up Yourself!</h1>
        <!-- Your form -->
        <form name="signupForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
            <!-- Form fields -->
            First Name:<br><input type="text" name="firstname" placeholder="First Name"><br><br>
            Last Name:<br><input type="text" name="lastname" placeholder="Last Name"><br><br>
            Age:<br><input type="text" name="age" placeholder="Age"><br><br>
            Mobile No:<br><input type="text" name="mobileno" placeholder="Mobile No"><br><br>
            Email Id:<br><input type="text" name="emailid" placeholder="Email Id"><br><br>
            Username:<br><input type="text" name="username" placeholder="Username"><br><br>
            Password:<br><input type="password" name="password" placeholder="Password"><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['age']) && isset($_POST['mobileno']) && isset($_POST['emailid']) && isset($_POST['username']) && isset($_POST['password'])) {
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
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $age = $_POST['age'];
            $mobileno = $_POST['mobileno'];
            $emailid = $_POST['emailid'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Prepare and bind SQL statement to insert data
            $sql = "INSERT INTO signup (firstname, lastname, age, mobileno, emailid, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssissss", $firstname, $lastname, $age, $mobileno, $emailid, $username, $password);

            // Execute the prepared statement
            if ($stmt->execute()) {
                echo "You are registered.";
                echo "<script>alert('You are registered.')</script>"; // Display successful registration message
                $conn->close();
                header("Location: index.html");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                $conn->close();
            }
        } else {
            echo "Please fill in all fields";
        }
    }
    ?>
</body>
</html>
