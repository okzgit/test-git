<?php
//======================================================================
// Php Script to request and receive data from database (Keywords).
// [ 'keyword' ]
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

$sql = "SELECT keyword FROM keywords WHERE k_id IN (SELECT k_id FROM relations WHERE c_id IN (SELECT c_id FROM companies WHERE name = '$q'))";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo $row['addr'] , $row['img_id'];
     echo    $row["keyword"] , " ,";
        }
} else {
    echo "0 results";
}
$conn->close();
?>