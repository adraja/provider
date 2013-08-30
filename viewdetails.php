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
$userid=$_GET["userid"];
$usertestsid = $_GET["usertestsid"];
$qrystr = "select firstname,lastname,email,bmi,weight from user where id=".$userid;
echo $qrystr;
$res = $mysqli->query($qrystr);
if ( $res && $res->num_rows > 0 )
{
  $row = $res->fetch_row();
  $firstname=$row[0];
  $lastname=$row[1];
  $email=$row[2];
  $bmi=$row[3];
  $weight=$row[4];

  include("customerheader.php");

  $form = new Form("Custome Information");
  $form->configure(array("action" => "updatecustomer.php", "method" => "get"));
  $form->addElement(new Element\HTML("<img src='Nutriligence.png'><h1>Customer Information</h1>"));
  $form->addElement(new Element\Hidden("userid", $userid));
  $form->addElement(new Element\Hidden("usertestsid", $usertestsid));
  $form->addElement(new Element\TextBox("Email: ", "email", array("readonly"=>true, "value" => $email)));
  $form->addElement(new Element\TextBox("First Name: ", "firstname", array("readonly"=>true, "value" => $firstname)));
  $form->addElement(new Element\TextBox("Last Name: ", "lastname", array("readonly"=>true, "value" => $lastname)));
  $form->addElement(new Element\TextBox("BMI: ", "bmi", array("value" => $bmi)));
  $form->addElement(new Element\TextBox("Weight: ", "weight", array("value" => $weight)));
  $qrystr2 = "select score,taken, details,recommendation from usertests where id=".$usertestsid;
  $res2 = $mysqli->query($qrystr2);
  if ( $res2 && $res2->num_rows > 0 )
  {
      $row = $res2->fetch_row();
      $score = $row[0];
      $taken = $row[1];
      $details = $row[2];
      $recommendation = $row[3];
      $form->addElement(new Element\HTML("    Score: ".$score." Taken on: ".substr($taken,0,10)." at ".substr($taken,11,8)."<p>")); 
      $form->addElement(new Element\TextArea("Details: ", "details", array("readonly"=>true, "value" => $details)));
      $form->addElement(new Element\TextArea("Recommendation: ", "recommendation", array("readonly"=>true, "value" => $recommendation)));
  }
  $form->addElement(new Element\Button("Submit"));
  
  $form->render();

  include("customerfooter.php");
}
else
{
    echo "<h1>Login Failed</h1>\n";
    include("customerfooter.php");

}
$mysqli->close();
?>
