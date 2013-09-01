<?php

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
if ( isset($_GET["search"]) )
{
  header('Location:customer.php?contactemail=".$contactemail."&password=".$password."&firstname=".$_GET[firstname]."&lastname=".$_GET["lastname"]."&email=".$_GET["email"]."&scancode=".$_GET["scancode"]');
}
$userid = $_GET["userid"];
$score = $_GET["score"];
$bmi = $_GET["bmi"];
$weight = $_GET["weight"];
$details = $_GET["details"];
$recommendation = $_GET["recommendation"];
$insqry = "update usertests set score=".$score.",bmi=".$bmi.",weight=".$weight.",details='".$details."',recommendation='".$recommendation."'";;
$mysqli->query($insqry);
echo "<h1>Successfully Updated Assessment for ".$userid."</h1>";

$mysqli->close()

?>
