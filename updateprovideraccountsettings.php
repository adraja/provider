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
$name = $_GET["name"];
$providertype = $_GET["providertype"];
$contactemail = $_GET["contactemail"];
$contactphone = $_GET["contactphone"];
$address1 = $_GET["address1"];
$address2 = $_GET["address2"];
$city = $_GET["city"];
$zip = $_GET["zip"];
$updqry = "update provider set providertype='".$providertype."',contactphone='".$contactphone."',address1='".$address1."', address2='".$address2."', city='".$city."', zip='".$zip."' where contactemail='".$contactemail."'";
echo $updqry;
$mysqli->query($updqry);
echo "<h1>Successfully Update Account Settings for ".$name."</h1>";
    $mysqli->query($updqry);
  include("providerheader.php");
    echo "<h1>Successfully Changed Account Settings for ".$name."</h1>";
    include("providerfooter.php");
$mysqli->close()

?>
