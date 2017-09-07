<?php
/*
+-------------------------------------------------------------------------+
| Copyright (C) 2006 Michael Earls                                        |
|                                                                         |
| This program is free software; you can redistribute it and/or           |
| modify it under the terms of the GNU General Public License             |
| as published by the Free Software Foundation; either version 2          |
| of the License, or (at your option) any later version.                  |
|                                                                         |
| This program is distributed in the hope that it will be useful,         |
| but WITHOUT ANY WARRANTY; without even the implied warranty of          |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           |
| GNU General Public License for more details.                            |
+-------------------------------------------------------------------------+
| - phpIP - http://www.phpip.net/                                         |
+-------------------------------------------------------------------------+
*/

ob_start();

// include the layout file
include 'layout.php';

 login_check();

 admin_check();

switch ($_REQUEST["mode"]) {

case "add":
{
  if (isset ($_POST['adgroup'])) { $adgroup = strip_tags($_POST['adgroup']); }

// Use the myheader function from layout.php
myheader("Adding Group");


$update = mysql_query("SELECT `group` FROM `groups` WHERE `group` = '$adgroup'");
        $num_results = mysql_num_rows($update);
	if ($num_results == '0') {
		$update = mysql_query("INSERT INTO `groups` (`group`) VALUES ('$adgroup')");
	?>
	  <h2><font color="FF0000">Updating Database, Please wait</font></h2>
	  <meta http-equiv=Refresh content=1;url="group_add.php">
	<?php	
	} else {
		echo "<h2><font color=\"FF0000\">Duplicate entry in the database ($adgroup), Please use<br />
				your browser back button and complte the form.</font></h2>";
	}
}
break;

default:

// Use the myheader function from layout.php
myheader("Add Group");

  echo "<FORM action=\"group_add.php?mode=add\" method=\"post\" name=\"groupadd\">";
  echo "<table class=\"listTable\" style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\">";
  echo "<TR class=\"listCell\">";
  echo "<TD colspan=\"2\" class=\"listCell\">GROUP ADD</TD>";
  echo "</TR>";
  echo "<TR class=\"listHeadRow\">";
  echo "<TD colspan=\"2\" class=\"listCell\">GROUPS</TD>";
  echo "</TR>";
  echo "<TR class=\"listRow2\">";
  echo "<TD class=\"listCell\">Name</TD>";
  echo "<TD class=\"listCell\">&nbsp;<INPUT name=\"adgroup\" value=\"\"></TD>";
  echo "</TR>";
  echo "</table>";
  echo "<a href=\"javascript:document.groupadd.submit()\">[ADD]</a>";
  echo "</form>";
  
// Use the footer function from layout.php
  footer();

} // end switch
//------------------------------------------------------------------------------------------
?>

