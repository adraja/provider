<?php

session_start();

$databaseserver="mysql-nfcsoc.lifera.com";
$database="nfcsoc";
$databaseuser="trefera11";
$databasepassword="281064";
$mysqli = new mysqli($databaseserver, $databaseuser, $databasepassword, $database); 
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_errno();
}
else 
{
	//  echo "Connection was OK!\n";
}

$userid = $_GET["userid"];
if (!isset($userid)){
	echo "No User set - Invalid operation<br />";
	return;
} 
$resultsarr = array();
$xaxis_arr = array();
$yaxis_arr = array();

$resultsarr[0]['xaxis'] = "Time";
$resultsarr[0]['yaxis'] = "Score";

if ( $res = $mysqli->query("select taken, score from usertests where userid = ".$userid))
{
	while ( $row = $res->fetch_row() )
	{
		array_push($xaxis_arr, $row[0]);
		array_push($yaxis_arr, $row[1]);
	}
}
$mysqli->close();

$i = 0;
foreach ($xaxis_arr as $x){
	$resultsarr[$i+1]['xaxis'] = $x;
	$resultsarr[$i+1]['yaxis'] = $yaxis_arr[$i];
	//echo $resultsarr[$i+1]['xaxis'].",";
	$i++;
}
//echo "<br />";

$str=json_encode($resultsarr);

echo $str;

?>
