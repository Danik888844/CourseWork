<?php

$search = $_POST["search"];

$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "myblog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT  * FROM `posts` WHERE (`name` LIKE '". $search ."%' OR `description` LIKE '". $search ."%')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["description"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
