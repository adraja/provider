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
$name = $_GET["name"];
$providertype = $_GET["providertype"];
$contactemail = $_GET["contactemail"];
$password = $_GET["password"];
$addr1 = $_GET["addr1"];
$addr2 = $_GET["addr2"];
$city = $_GET["city"];
$state = $_GET["state"];
$zip = $_GET["zip"];
$contactphone = $_GET["contactphone"];
$insqry = "insert into provider (name,providertype,contactemail,password, address1,address2,city,state,zip,contactphone) values ('".$name."','".$providertype."','".$contactemail."','".$password."','".$addr1."','".$addr2."','".$city."','".$state."','".$zip."','".$contactphone."')";
$mysqli->query($insqry);
echo "<h1>Successfully Added Provider ".$name."</h1>";

$mysqli->close()

?>
