<?php
// Establishing a database connection
$conn = new mysqli("localhost", "root", "", "swapbook");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure the required fields are set and not empty
    if (isset($_POST['username'], $_POST['bookname'], $_POST['author'], $_POST['price']) && !empty($_POST['username']) && !empty($_POST['bookname']) && !empty($_POST['author']) && !empty($_POST['price'])) {
        
        // Sanitize and assign the input values
        $username = $conn->real_escape_string($_POST['username']);
        $bookname = $conn->real_escape_string($_POST['bookname']);
        $author = $conn->real_escape_string($_POST['author']);
        $price = $_POST['price'];

        // Prepare the SQL statement using a prepared statement
        $sql = "INSERT INTO buysellinfo (Username, Action, BookName, Author, Price) VALUES (?, 'sell', ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->bind_param("sssi", $username, $bookname, $author, $price);

        if ($stmt->execute()) {
            echo "Book is now available for selling!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill in all fields.";
    }
}

// Close the database connection
$conn->close();
?>
