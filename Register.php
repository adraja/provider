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
$options = array("Family Practice", "Internal Medicine", "OBGYN", "Osteopathic Medicine", "Pharmacist", "Plastic Surgeon", "Psychiatry");
$form = new Form("Create Provider Account");
$form->configure(array("action" => "createprovider.php", "method" => "get"));
$form->addElement(new Element\HTML("<img src='Nutriligence.png'><h1>Add a Screening Provider</h1>"));
$form->addElement(new Element\TextBox("Name:", "name"));
$form->addElement(new Element\Select("Provider Type:", "providertype", $options));
$form->addElement(new Element\TextBox("Contact email:", "contactemail"));
$form->addElement(new Element\TextBox("Password:", "password"));
$form->addElement(new Element\TextBox("Stree Address1:", "addr1"));
$form->addElement(new Element\TextBox("Stree Address2:", "addr2"));
$form->addElement(new Element\TextBox("City:", "city"));
$form->addElement(new Element\TextBox("State:", "state"));
$form->addElement(new Element\TextBox("Zip:", "zip"));
$form->addElement(new Element\TextBox("Contact Phone:", "contactphone"));
$form->addElement(new Element\Button("Submit"));
$form->addElement(new Element\Button("Cancel", "button", array("onclick" => "history.go(-1);")));
$form->render();
$mysqli->close();
?>
