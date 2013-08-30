<?php

//  echo "Connection was OK!\n";
$contactemail=$_GET["contactemail"];
$password=$_GET["password"];
echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\n";
  echo "  <tr valign=\"top\">\n";
  echo "    <td width=\"200\" class=\"menu\">";
  echo "<h3>Logged in: </h3><p>".$contactemail."<p>";
  echo "<a href=\"providerindex.php\"><input type=\"button\" value=\"Logout\"></a>\n";
  echo "    <h2>MENU</h2>\n";
  echo "              <a href=\"/provider/provideraccountsettings.php?contactemail=".$contactemail."&password=".$password."\">Account Settings</a><br/><p><p>\n";
  echo "              <a href=\"/provider/customer.php?contactemail=".$contactemail."&password=".$password."\">Customer</a><br/><p>\n";
  echo "              <a href=\"/provider/finduser.php?contactemail=".$contactemail."&password=".$password."\">Find User</a><p><br />\n";
  echo "            <br /><br />";
  echo "    </td>\n";
  echo "    <td width=\"600\" height=\"800\" class=\"content\">\n";
  ?>
