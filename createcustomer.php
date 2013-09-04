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
$contactemail = $_SESSION["contactemail"];
$password = $_SESSION["password"];
if ( isset($_GET["search"]) )
{
  header('Location:customer.php?contactemail=".$contactemail."&password=".$password."&firstname=".$_GET[firstname]."&lastname=".$_GET["lastname"]."&email=".$_GET["email"]."&scancode=".$_GET["scancode"]');
}
$providerid = $_GET["providerid"];
$customertype = $_GET["customertype"];
$email = $_GET["email"];
$firstname = $_GET["firstname"];
$lastname = $_GET["lastname"];
$scancode = $_GET["scancode"];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<h2>This ($email) email address is not valid./<h2>";
  }
  else {
   $qrystr = "select id from user where email='".$email."'";
   $res = $mysqli->query($qrystr);
   if ( $res && $res->num_rows > 0 )
   {
     echo "<h2>Duplicate email ($email) Entered.</h2>";
   }
  else {
   if ( $firstname == "" && $lastname == "" ) {
    echo "<h2>Both First name and last name are blank.</h2>";
   }
   else {
     $qrystr = "select id from user where scancode='".$scancode."'";
     $res = $mysqli->query($qrystr);
     if ( $res && $res->num_rows > 0 )
     {
       echo "<h2>Duplicate Scan Code ($scancode) Entered.</h2>";
     }
     else {
      $insqry = "insert into user (firstname,lastname,email,scancode,customertype,providerid) values ('".$firstname."','".$lastname."','".$email."','".$scancode."','".$customertype."','".$providerid."')";
      $mysqli->query($insqry);
      echo "Successfully Added Customer ".$lastname,", ".$firstname."";
     }
   }
  }
}
echo "<a href=\"customer.php?contactemail=".$contactemail."&password=".$password."&email=".$email."&firstname=".$firstname."&lastname=".$lastname."&scancode=".$scancode."\">BACK</a>\n";

$mysqli->close()

?>
