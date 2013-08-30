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
$qrystr = "select id,name,providertype,contactemail,contactphone,address1,address2,city,zip from provider where contactemail='".$contactemail."' and password='".$password."'";
$res = $mysqli->query($qrystr);
if ( $res && $res->num_rows > 0 )
{
  $row = $res->fetch_row();
  $providerid=$row[0];
  $name=$row[1];
  $providertype = $row[2];
  $contactemail=$row[3];
  $contactphone=$row[4];
  $address1=$row[5];
  $address2=$row[6];
  $city=$row[7];
  $zip=$row[8];

  include("providerheader.php");
  $form = new Form("Provider Account Settings");
  $options = array("Family Practice", "Internal Medicine", "OBGYN", "Osteopathic Medicine", "Pharmacist", "Plastic Surgeon", "Psychiatry");
  $form->configure(array("action" => "updateprovideraccountsettings.php", "method" => "get"));
  $form->addElement(new Element\HTML("<img src='Nutriligence.png'><h1>Provider Account Settings</h1>"));
  $form->addElement(new Element\Hidden("providerid", $providerid));
  $form->addElement(new Element\Hidden("password", $password));
  $form->addElement(new Element\TextBox("Name:", "name", array("value" => $name)));
  $form->addElement(new Element\Select("Provider Type:", "providertype", $options, array("value"=>$providertype)));
  $form->addElement(new Element\TextBox("Contact Email:", "contactemail", array("value" => $contactemail)));
  $form->addElement(new Element\TextBox("Contact Phone:", "contactphone", array("value" => $contactphone)));
  $form->addElement(new Element\TextBox("Address1:", "address1", array("value" => $address1)));
  $form->addElement(new Element\TextBox("Address2:", "address2", array("value" => $address2)));
  $form->addElement(new Element\TextBox("City:", "city", array("value" => $city)));
  $form->addElement(new Element\TextBox("Zip:", "zip", array("value" => $zip)));
  $form->addElement(new Element\Button("Submit"));
  $form->addElement(new Element\Button("Cancel", "button", array("onclick" => "history.go(-1);")));
  $form->render();
  $mysqli->close();
 
  include("providerfooter.php");
}
else
{
    echo "<h1>Login Failed</h1>\n";
    include("providerfooter.php");

}
$mysqli->close();
?>
