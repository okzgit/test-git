<?php
//======================================================================
// Php Script to request and receive data from database (Keywords).
// [ 'keyword' ]
// The output will be in JSON Format.
//======================================================================


//* Url parameter.
$q = $_GET['q'];


//* MySQL Connection initialization.
$con = mysqli_connect('localhost','root','','w2do');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//* Database selection.
mysqli_select_db($con,"w2do");

//* Query.
$sql="SELECT * FROM keywords WHERE keyword like '%".$q."%'";
 $json=array();
 
 //* Result of the Query.
$result = mysqli_query($con,$sql);

//* Loop to populate array object.
while($row = mysqli_fetch_array($result)) {
	 array_push($json, $row['keyword']);
	// echo $row['keyword'];
}

//* Encoding to JSON and 'echo' back.
echo json_encode($json);
?>
