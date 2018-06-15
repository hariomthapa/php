// <?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $db='schooldb'

// // Create connection
// $db = new mysqli($servername, $username, $password, $db) or die("No Connection");

// echo "Connected successfully";

// ?>

<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>

