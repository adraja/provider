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
$qrystr = "select firstname,lastname,email,scancode from user where id=".$userid;
$res = $mysqli->query($qrystr);
if ( $res && $res->num_rows > 0 )
{
  $row = $res->fetch_row();
  $firstname=$row[0];
  $lastname=$row[1];
  $email=$row[2];
  $scancode = $row[3];
  include("customerheader.php");

  $form = new Form("Screening Information");
  $form->configure(array("action" => "updatecustomer.php", "method" => "get"));
  $form->addElement(new Element\HTML("<img src='Nutriligence.png'><h1>Customer Screening Information</h1>"));
  $form->addElement(new Element\Hidden("userid", $userid));
  $form->addElement(new Element\Hidden("usertestsid", $usertestsid));
  $form->addElement(new Element\TextBox("Email: ", "email", array("readonly"=>true, "value" => $email)));
  $form->addElement(new Element\TextBox("Scan Code: ", "scancode", array("readonly"=>true, "value" => $scancode)));
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
   }
   else
   {
      $score = 18000;
      $taken = "";
      $bmi = 25.0;
      $weight = 100;
      $details = "";
      $recommendation = "";
   }
      $form->addElement(new Element\TextBox("Score: ", "score", array("value" => $score)));
      $form->addElement(new Element\TextBox("Taken: ", "taken", array("value" => substr($taken,0,10))));
      $form->addElement(new Element\TextBox("BMI: ", "bmi", array("value" => $bmi)));
      $form->addElement(new Element\TextBox("Weight: ", "weight", array("value" => $weight)));
      $form->addElement(new Element\TextArea("Details: ", "details", array("value" => $details)));
      $form->addElement(new Element\TextArea("Recommendation: ", "recommendation", array("value" => $recommendation)));
  $form->addElement(new Element\Button("Submit"));
  $form->render();
  echo "<table id=\"table0\" width=\"700\" border=\"1\">\n";
  echo "  <tbody>\n";
  echo "  <tr>\n";
  echo "    <th width=\"40\" scope=\"col\">ID</th>\n";
  echo "    <th width=\"10\" scope=\"col\">Score</th>\n";
  echo "    <th width=\"30\" scope=\"col\">Date</th>\n";
  echo "    <th width=\"100\" scope=\"col\">What does it mean</th>\n";
  echo "    <th width=\"100\" scope=\"col\">How to improve</th>\n";
  echo "    <th width=\"100\" scope=\"col\">Recommended Supplement</th>\n";
  echo "  </tr>\n";
  $qrystr3 = "select id,score,taken from usertests where userid=".$userid." and id!=".$usertestsid;
  $res3 = $mysqli->query($qrystr3);
  if ( $res3 && $res3->num_rows > 0 )
  {
 
    $num_rows = $res3->num_rows;
    while ( $num_rows > 0 )
    {
      $user = $res->fetch_row();
      $id = $user[0];
      $score = $user[1];
      $taken = $user[2];
  
      echo "  <tr>\n";
      echo "    <td>".$id."</td>\n";
      echo "    <td>".$score."</td>\n";
      echo "    <td>".substr($taken,0,10)."</td>\n";
      echo "    <td><a href='whatdoesitmean.php?userid=".$id."&usertestsid=".$usertestsid."'>View Details</a></td>\n";
      echo "    <td><a href='howtoimprove.php?userid=".$id."&usertestsid=".$usertestsid."'>View Details</a></td>\n";
      echo "  </tr>\n";
      $num_rows = $num_rows-1;
    }
  }

  include("customerfooter.php");
}
else
{
    echo "<h1>Login Failed</h1>\n";
    include("customerfooter.php");

}
$mysqli->close();
?>
