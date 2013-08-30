<?php

use PFBC\Form;
use PFBC\Element;

session_start();

include("PFBC/Form.php");
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
$contactemail=$_GET["contactemail"];
$password=$_GET["password"];
$qrystr = "select id,name,contactemail,contactphone,address1,address2,city,zip from provider where contactemail='".$contactemail."' and password='".$password."'";
$res = $mysqli->query($qrystr);
if ( $res && $res->num_rows > 0 )
{
  $row = $res->fetch_row();
  $providerid=$row[0];
  $name=$row[1];
  $contactemail=$row[2];
  $contactphone=$row[3];
  $address1=$row[4];
  $address2=$row[5];
  $city=$row[6];
  $zip=$row[7];

  include("providerheader.php");
  if ( !isset($email) )
  {
    $email = "";
  }
  if ( !isset($firstname) )
  {
    $firstname = "";
  }
  if ( !isset($lastname) )
  {
    $lastname = "";
  }
  $form = new Form("Customer Information");
  $form->configure(array("action" => "createcustomer.php", "method" => "get"));
  $form->addElement(new Element\HTML("<img src='Nutriligence.png'><h1>Customers</h1>"));
  $form->addElement(new Element\Radio("Customer Type", "customertype", array("Individual", "Employee"), array("value"=>"Individual")));
  $form->addElement(new Element\Hidden("providerid", $providerid));
  $form->addElement(new Element\TextBox("Email: ", "email", array("value" => $email)));
  $form->addElement(new Element\TextBox("First Name: ", "firstname", array("value" => $firstname)));
  $form->addElement(new Element\TextBox("Last Name: ", "lastname", array("value" => $lastname)));
  $form->addElement(new Element\Button("Create Customer"));
  
  $form->render();

echo "<table id=\"table0\" width=\"700\" border=\"1\">\n";
echo "  <caption>\n";
echo "    <strong>Customer List</strong>\n";
echo "  </caption>\n";
echo "  <tbody>\n";
echo "  <tr>\n";
echo "    <th width=\"40\" scope=\"col\">ID</th>\n";
echo "    <th width=\"10\" scope=\"col\">First Name</th>\n";
echo "    <th width=\"30\" scope=\"col\">Last Name</th>\n";
echo "    <th width=\"100\" scope=\"col\">Email</th>\n";
echo "    <th width=\"100\" scope=\"col\">Type</th>\n";
echo "    <th width=\"100\" scope=\"col\">Status</th>\n";
echo "    <th width=\"100\" scope=\"col\">Last Scan On</th>\n";
echo "    <th width=\"100\" scope=\"col\">View Details</th>\n";
echo "    <th width=\"100\" scope=\"col\">Scan Again</th>\n";
echo "  </tr>\n";
$qrystr = "select id,firstname,lastname,email,customertype,status from user where providerid=".$providerid;
$res = $mysqli->query($qrystr);
if ( $res && $res->num_rows >= 0 )
{
  $num_rows = $res->num_rows;
  while ( $num_rows > 0 )
  {
    $user = $res->fetch_row();
    $id = $user[0];
    $firstname = $user[1];
    $lastname = $user[2];
    $email = $user[3];
    $customertype = $user[4];
    $status = $user[5];
  
    echo "  <tr>\n";
    echo "    <td>".$id."</td>\n";
    echo "    <td>".$firstname."</td>\n";
    echo "    <td>".$lastname."</td>\n";
    echo "    <td>".$email."</td>\n";
    echo "    <td>".$customertype."</td>\n";
    echo "    <td>".$status."</td>\n";
    $qrystr2 = "select id,taken from usertests where userid=".$id." order by taken desc limit 1";
    $res2 = $mysqli->query($qrystr2);
    if ( $res2 && $res2->num_rows > 0 )
    {
      $usertestsid = $res2->fetch_row()[0];
      echo "    <td>".substr($res2->fetch_row()[1],0, 10)."</td>\n";
      echo "    <td><a href='viewdetails.php?userid=".$id."&usertestsid=".$usertestsid."'>View Details</a></td>\n";
    }
    else
    {
      $usertestsid = 0;
      echo "     <td>Not Done</td>\n";
      echo "     <td></td>\n";
    }
    echo "    <td><a href='viewdetails.php?userid=".$id."'>View Details</a></td>\n";
    echo "    <td><a href='scanagain.php?userid=".$id."'>Scan Again</a></td>\n";
    echo "  </tr>\n";
    $num_rows = $num_rows-1;
  }
}

echo "</table>\n";

  include("providerfooter.php");
}
else
{
    echo "<h1>Login Failed</h1>\n";
    include("providerfooter.php");

}
$mysqli->close();
?>
