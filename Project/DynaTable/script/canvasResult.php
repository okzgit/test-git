<?php
//======================================================================
// Php Script to request and receive data from database (Company details).
// [ 'addr', 'img_id', 'web' ]
// The output will be in String Format.
//======================================================================


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "w2do";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//* Url parameter.
$q = $_GET['q'];

$sql = "SELECT addr, img_id, web, lat, lon FROM companies WHERE name='$q'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo $row['addr'] , $row['img_id'];
     echo    $row["addr"]. " - " . $row["img_id"]. " - " . $row["web"].  " - " . $row["lat"]. " - " . $row["lon"];
        }
} else {
    echo "0 results";
}
$conn->close();
?>