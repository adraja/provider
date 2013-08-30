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
$providerid = $_GET["providerid"];
$customertype = $_GET["customertype"];
$email = $_GET["email"];
$firstname = $_GET["firstname"];
$lastname = $_GET["lastname"];
$insqry = "insert into user (firstname,lastname,email,customertype,providerid) values ('".$firstname."','".$lastname."','".$email."','".$customertype."','".$providerid."')";
$mysqli->query($insqry);
echo "<h1>Successfully Added Customer ".$firstname."</h1>";

$mysqli->close()

?>
