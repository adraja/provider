<?php
//  echo "Connection was OK!\n";
$userid=$_GET["userid"];
$usertestsid=$_GET["usertestsid"];
echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\n";
  echo "  <tr valign=\"top\">\n";
echo "    <td width=\"200\" class=\"menu\">";
echo "    <h2>MENU</h2>\n";
  echo "              <a href=\"/provider/viewdetails.php?userid=".$userid."&usertestsid=".$usertestsid."\">User Settings</a><br/><p><p>\n";
  echo "              <a href=\"/provider/assesscustomer.php?userid=".$userid."&usertestsid=".$usertestsid."\">Assess Customer</a><br/><p>\n";
  echo "              <a href=\"/provider/customermessages.php?userid=".$userid."&usertestsid=".$usertestsid."\">Messages</a><p><br />\n";
  echo "            <br /><br />";
  echo "    </td>\n";
  echo "    <td width=\"600\" height=\"800\" class=\"content\">\n";
  ?>
