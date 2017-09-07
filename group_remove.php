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

case "remove":
{
  if (isset ($_POST['gremove'])) { $gremove = strip_tags($_POST['gremove']); }

// Use the myheader function from layout.php
myheader("Updating");

if (isset($_POST[gremove])) { $i = 0;
  if (count($_POST[gremove]) > 0)
        foreach ($_POST[gremove] as $groupremove) {
          $GroupRemove = mysql_query("DELETE FROM `groups` WHERE `id` = '$groupremove'");
	  $NetGrUpdate = mysql_query("UPDATE `NetMenu` SET `groupid` = '1' WHERE `groupid` = '$groupremove'");
        $i++;
  }
}

$optimize = mysql_result(mysql_query("OPTIMIZE TABLE `group`"),0);

// Redirect to cidr_remove.php after sql insert
?>
  <h2><font color="FF0000">Updating Database, Please wait</font></h4>
  <meta http-equiv=Refresh content=1;url="group_remove.php">

<?php

}
break;

default:

// Use the myheader function from layout.php
myheader("Groups Remove");

  echo "<table class=\"listTable\" style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\">";
  echo "<FORM action=\"group_remove.php?mode=remove\" method=\"post\" name=\"groupremove\">";
  echo "<tr class=\"tableheader\">";
  echo "<td colspan=6 class=\"listCell\">REMOVE GROUPS</td>";
  echo "<tr class=\"listHeadRow\">";
  echo "<td class=\"listCell\">&nbsp;</td>";
  echo "<td class=\"listCell\">GROUPS</td>";
  echo "</tr>";

  $pdesc = mysql_query("SELECT * FROM `groups` WHERE `group` != 'default'");
  while ($row = mysql_fetch_array($pdesc))
    {
      if ($RowClass == "listRow2") { $RowClass = "listRow1";  }
      else { $RowClass = "listRow2"; }
	  echo "<tr class=\"$RowClass\" class=\"listCell\">";
	  echo "<td class=\"listCell\" width=\"20\"><INPUT TYPE=\"checkbox\" NAME=\"gremove[]\" VALUE=\"$row[id]\"></td>";
	  echo "<td class=\"listCell\">&nbsp;$row[group]</td>";
  	  echo "</tr>";
	}
  echo "</table>";
  echo "<input TYPE=\"Image\" src=\"i/remove.png\" onClick=\"document.groupremove.submit();\">";
  echo "</form>";

  // Use the footer function from layout.php
  footer();

} // end switch
//------------------------------------------------------------------------------------------
?>
