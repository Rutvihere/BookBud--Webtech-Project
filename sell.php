<!DOCTYPE html>
<html>
<head>
    <title>Sell a Book!!</title>
    <link rel='stylesheet' type='text/css' href='sel.css'/>
    <script>
        function validateForm() {
            var username = document.forms["sellForm"]["username"].value;
            var bookname = document.forms["sellForm"]["bookname"].value;
            var author = document.forms["sellForm"]["author"].value;
            var price = document.forms["sellForm"]["price"].value;

            if (username === "" || bookname === "" || author === "" || price === "") {
                alert("Please fill in all fields");
                return false; // Prevent form submission if fields are empty
            }
            return true; // Submit the form if all fields are filled
        }
    </script>
</head>
<body>
    <div>
        <div class="textdesign">
            <h1>Sell Your Book!</h1>
            <form name="sellForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
                User Name:<br><br>
                <input type="text" name="username" placeholder="User Name"><br><br>
                Name of the Book:<br><br>
                <input type="text" name="bookname" placeholder="Book Name"><br><br>
                The Author:<br><br>
                <input type="text" name="author" placeholder="Author"><br><br>
                Your Price:<br><br>
                <input type="text" name="price" placeholder="Price"><br><br>
                <input class="button" type="submit" value="Submit">
            </form>
            <li><a href="userpage.html">User Page</a></li>
        </div>
    </div>

    <?php
    $conn = new mysqli("localhost", "root", "", "swapbook");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['username'], $_POST['bookname'], $_POST['author'], $_POST['price']) && !empty($_POST['username']) && !empty($_POST['bookname']) && !empty($_POST['author']) && !empty($_POST['price'])) {
            $username = $conn->real_escape_string($_POST['username']);
            $bookname = $conn->real_escape_string($_POST['bookname']);
            $author = $conn->real_escape_string($_POST['author']);
            $price = $_POST['price'];

            $sql = "INSERT INTO buysellinfo (Username, Action, BookName, Author, Price) VALUES (?, 'sell', ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param("sssi", $username, $bookname, $author, $price);

            if ($stmt->execute()) {
                echo "<script>alert('Book out for Selling');</script>";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "<script>alert('Please fill in all fields.');</script>";
        }
    }

    $conn->close();
    ?>
</body>
</html>
