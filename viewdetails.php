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
$qrystr = "select firstname,lastname,email,yearofbirth,gender from user where id=".$userid;
echo $qrystr;
$res = $mysqli->query($qrystr);
if ( $res && $res->num_rows > 0 )
{
  $row = $res->fetch_row();
  $firstname=$row[0];
  $lastname=$row[1];
  $email=$row[2];
  $yearofbirth=$row[3];
  $age = 2013-intval($yearofbirth);
  $gender=$row[4];

  include("customerheader.php");

  $form = new Form("Custome Information");
  $form->configure(array("action" => "showhistory.php", "method" => "get"));
  $form->addElement(new Element\HTML("<img src='Nutriligence.png'><h1>Customer Information</h1>"));
  $form->addElement(new Element\Hidden("userid", $userid));
  $form->addElement(new Element\Hidden("usertestsid", $usertestsid));
  $form->addElement(new Element\TextBox("Email: ", "email", array("readonly"=>true, "value" => $email)));
  $form->addElement(new Element\TextBox("Name: ", "name", array("readonly"=>true, "value" => $lastname.", ".$firstname)));
   $form->addElement(new Element\TextBox("Age: ", "age", array("readonly"=>true, "value" => $age)));
  $form->addElement(new Element\TextBox("Gender: ", "gender", array("readonly"=>true, "value" => $gender)));
  $qrystr2 = "select score,taken,bmi,weight,details,recommendation from usertests where id=".$usertestsid;
  $res2 = $mysqli->query($qrystr2);
  if ( $res2 && $res2->num_rows > 0 )
  {
      $row = $res2->fetch_row();
      $score = $row[0];
      $taken = $row[1];
      $bmi = $row[2];
      $weight = $row[3];
      $details = $row[4];
      $recommendation = $row[5];
      $form->addElement(new Element\TextBox("Score: ", "score", array("readonly"=>true, "value" => $score)));
      $form->addElement(new Element\TextBox(" Taken on:", "taken", array("readonly"=>true, "value" => $taken)));
      $form->addElement(new Element\TextBox(" BMI:", "bmi", array("readonly"=>true, "value" => $bmi)));
      $form->addElement(new Element\TextBox(" Weight:", "weight", array("readonly"=>true, "value" => $weight)));
      $form->addElement(new Element\TextArea("Details: ", "details", array("readonly"=>true, "value" => $details)));
      $form->addElement(new Element\TextArea("Recommendation: ", "recommendation", array("readonly"=>true, "value" => $recommendation)));
  }
  $form->addElement(new Element\Button("History"));
  
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
