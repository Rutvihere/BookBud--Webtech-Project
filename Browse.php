<!DOCTYPE html>
<html>
<head>
    <link rel='stylesheet' type='text/css' href='foru.css'/>
</head>
<body>
    
    
    <li><a href="userpage.html">User Page</a></li>
    <br>
    <form method="post">
        <input type="text" name="search" placeholder="Search by Author or Book Name">
        <input type="submit" value="Search">
    </form>

    <?php
    $conn = new mysqli("localhost", "root", "", "swapbook");
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $search = $_POST['search'];

        $sql_select = "SELECT DISTINCT Username, BookName, Author, Price FROM buysellinfo WHERE Action = 'sell' AND (Author LIKE '%$search%' OR BookName LIKE '%$search%')";
    } else {
        $sql_select = "SELECT DISTINCT Username, BookName, Author, Price FROM buysellinfo WHERE Action = 'sell'";
    }

    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        echo "<h1>Books available in the market:</h1>";
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "Username: " . $row["Username"] . "<br>";
            echo "Book Name: " . $row["BookName"] . "<br>";
            echo "Author: " . $row["Author"] . "<br>";
            echo "Price: " . $row["Price"] . "<br>";
            echo "</div><br><br>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
</body>
</html>
