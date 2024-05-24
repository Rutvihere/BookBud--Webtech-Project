<!DOCTYPE html>
<html>
<head>
    <title>Buy a Book!!</title>
    <link rel='stylesheet' type='text/css' href='sel.css'/>
</head>
<body>
    <div>
        
        
        <div class="textdesign">
            <h1>Buy a Book!!</h1>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "swapbook";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection Failed: " . $conn->connect_error);
            }

            $bname = $_POST['bookname']; // Assuming you are receiving this from a form

            $check = "SELECT * FROM buysellinfo WHERE BookName = '$bname'";
            $result = $conn->query($check);

            if ($result) {
                $uniqueBooks = array();
                if (mysqli_num_rows($result) > 0) {
                    while ($obj = mysqli_fetch_object($result)) {
                        if (!in_array($obj->BookName, $uniqueBooks)) {
                            array_push($uniqueBooks, $obj->BookName);
                            $username = $obj->Username;
                            $price = $obj->Price;
                            echo '<div class="main"><div class="sellerinfo">';
                            echo '<p>Seller:</p><p>' . $username . '</p>';
                            echo '<p>Price:</p><p>' . $price . '</p>';
                            echo '<a href="address.php" class="buy-button">Buy</a>'; // Buy button that leads to address form
                            echo '</div></div>';
                        }
                    }
                } else {
                    echo "Sorry, no matches!";
                }
            } else {
                echo "Could not connect or query the database.";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
