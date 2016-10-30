
<?php
//======================================================================
// Php Script to request and receive data from database (Company details).
// [ 'name', 'address', 'webpage', 'latitude', 'longtidue' ]
// The output will be in JSON Format.
//======================================================================


//* Url parameter.
$q = $_GET['q'];

//* Default (w3School) MySQL Connection initialization.
$con = mysqli_connect('localhost','root','','w2do');


if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
//* Database selection.

mysqli_select_db($con,"w2do");
$sql="SELECT name, addr, web, lat, lon FROM companies WHERE c_id IN (SELECT c_id FROM relations WHERE k_id IN (SELECT k_id FROM keywords WHERE keyword IN ('$q')))";

 $json=array();

$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_assoc($result)) {
	 array_push($json, $row );
	
}
//echo json_encode($json, JSON_PRETTY_PRINT );
echo json_encode(array('records' => $json));
?>
