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

// Use the myheader function from layout.php
myheader("PREFIX REMOVE");


switch ($_REQUEST["mode"]) {

case "remove":
{
/*
/ mysql insert for prefix
*/

  if (isset ($_GET['prefix'])) { $prefix = strip_tags($_GET['prefix']); }

if (isset($_POST[prefix])) { $i = 0;
  if (count($_POST[prefix]) > 0)
        foreach ($_POST[prefix] as $prefixremove) {
	  $CidrRemove = mysql_query("DELETE FROM `net_ips` WHERE `netaddress` = '$prefixremove'");
	$i++;
  }
}

$optimize = mysql_result(mysql_query("OPTIMIZE TABLE `net_ips`"),0);

// Redirect to prefix_remove.php after sql insert
?>
  <h2><font color="FF0000">Updating Database, Please wait</font></h4>
  <meta http-equiv=Refresh content=1;url="prefix_remove.php">

<?php

}
break;

default:

  if (isset ($_GET['prefix'])) { $prefix = strip_tags($_GET['prefix']); }
  if (isset ($_GET['di'])) { $di = strip_tags($_GET['di']); }

$sqllist = mysql_query("SELECT * FROM `net_ips` ORDER BY `NetCidr` + 0");
?>

<FORM action="<?php $PHPSELF;?>?mode=remove" method=post name="prefixremove">
<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0">
  <tr class="listCell">
   <TD class="listCell" colspan="3">PREFIX REMOVE</TD>
  </tr>
  <tr class="listHeadRow">
   <td class="listCell">&nbsp;</td>
   <td class="listCell">IP</td>
   <td class="listCell">DESCRIPTION</td>
  </tr>
<?php
	while($row = mysql_fetch_array($sqllist))
	{
	if ($RowClass == "listRow2") { $RowClass = "listRow1";
         }
          else
           { $RowClass = "listRow2";
        }
        echo "<tr class=\"$RowClass\">";
	echo "<TD class=\"listCell\" width=\"20\"><INPUT TYPE=\"checkbox\" NAME=\"prefix[]\" VALUE=\"$row[netaddress]\"></td>";
	echo "<TD class=\"listCell\"> $row[netaddress]&nbsp;</td>";
	echo "<TD class=\"listCell\"> $row[ip_description]&nbsp;</TD>";
	echo "</tr>";
}
echo "</TABLE>";
echo "<input TYPE=\"Image\" src=\"i/remove.png\" onClick=\"document.prefixremove.submit();\">";
echo "</form>";

  // Use the footer function from layout.php
  footer();

} // end switch
//------------------------------------------------------------------------------------------
?>
