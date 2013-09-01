<?php

//  echo "Connection was OK!\n";
$userid=$_GET["userid"];
$usertestsid=$_GET["usertestsid"];
//  echo "Connection was OK!\n";
$contactemail=$_SESSION["contactemail"];
$password=$_SESSION["password"];
echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\n";
  echo "  <tr valign=\"top\">\n";
echo "    <td width=\"200\" class=\"menu\">";
  echo "<h3>Logged in: </h3><p>".$contactemail."<p>";
echo "    <h2>MENU</h2>\n";
  echo "              <a href=\"/provider/viewdetails.php?userid=".$userid."&usertestsid=".$usertestsid."\">User Settings</a><br/><p><p>\n";
  echo "              <a href=\"/provider/assesscustomer.php?userid=".$userid."&usertestsid=".$usertestsid."\">Screening Customer</a><br/><p>\n";
  echo "              <a href=\"/provider/customermessages.php?userid=".$userid."&usertestsid=".$usertestsid."\">Messages</a><p><br />\n";
  echo "            <br /><br />";
  echo "    </td>\n";
  echo "    <td width=\"600\" height=\"800\" class=\"content\">\n";
  ?>
