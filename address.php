<!DOCTYPE html>
<html>
<head>
    <title>Address Details</title>
    <link rel='stylesheet' type='text/css' href='address.css'/>
    <script>
        function validateForm() {
            var street = document.getElementsByName("street")[0].value.trim();
            var city = document.getElementsByName("city")[0].value.trim();
            var postal_code = document.getElementsByName("postal_code")[0].value.trim();
            var country = document.getElementsByName("country")[0].value.trim();
            var bookname = document.getElementsByName("bookname")[0].value.trim();
            var authorname = document.getElementsByName("authorname")[0].value.trim();
            var username = document.getElementsByName("username")[0].value.trim();

            if (street === "" || city === "" || postal_code === "" || country === "" || bookname === "" || authorname === "" || username === "") {
                alert("Please fill in all fields");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

        <div class="textdesign">
            <h1>Give Your Address Details</h1>
            <li><a href="userpage.html"> User Page </a></li>
            <br>
            <form name="addressForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
                User Name of the Seller:<br><br>
                <input type="text" name="username" placeholder="User Name"><br><br>
                Name of the Book:<br><br>
                <input type="text" name="bookname" placeholder="Book Name"><br><br>
                The Author:<br><br>
                <input type="text" name="authorname" placeholder="Author Name"><br><br>
                Street:<br><br>
                <input type="text" name="street" placeholder="Street"><br><br>
                City:<br><br>
                <input type="text" name="city" placeholder="City"><br><br>
                Postal Code:<br><br>
                <input type="text" name="postal_code" placeholder="Postal Code"><br><br>
                <input class="button" type="submit" value="Submit">
            </form>
            
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Establish a database connection
            $conn = new mysqli("localhost", "root", "", "swapbook");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $street = $_POST['street'];
            $city = $_POST['city'];
            $postal_code = $_POST['postal_code'];
            $bookname = $_POST['bookname'];
            $authorname = $_POST['authorname'];
            $username = $_POST['username'];

            // Remove the book entry from the table using prepared statements
            $stmt = $conn->prepare("DELETE FROM buysellinfo WHERE BookName = ? AND Author = ? AND Username = ?");
            $stmt->bind_param("sss", $bookname, $authorname, $username);

            if ($stmt->execute()) {
                echo "Book ordered successfully!";
            } else {
                echo "Error removing book: " . $conn->error;
            }

            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
