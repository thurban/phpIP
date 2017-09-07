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
myheader("CIDR REMOVE");


switch ($_REQUEST["mode"]) {

case "remove":
{
/*
/ mysql insert for prefix
*/

  if (isset ($_GET['cidr'])) { $cidr = strip_tags($_GET['cidr']); }

if (isset($_POST[cidr])) { $i = 0;
  if (count($_POST[cidr]) > 0)
        foreach ($_POST[cidr] as $cidrremove) {
	  $CidrRemove = mysql_query("DELETE FROM `NetMenu` WHERE `NetMenuId` = '$cidrremove'");
      $PrefixRemove = mysql_query("DELETE FROM `net_ips` WHERE `NetCidr` = '$cidrremove'");
      $AddressRemove = mysql_query("DELETE FROM `addresses` WHERE `NetID` = '$cidrremove'");
	$i++;
  }
}

$optimize = mysql_result(mysql_query("OPTIMIZE TABLE `NetMenu`"),0);
$optimize = mysql_result(mysql_query("OPTIMIZE TABLE `net_ips`"),0);
$optimize = mysql_result(mysql_query("OPTIMIZE TABLE `addresses`"),0);

// Redirect to cidr_remove.php after sql insert
?>
  <h2><font color="FF0000">Updating Database, Please wait</font></h4>
  <meta http-equiv=Refresh content=1;url="cidr_remove.php">

<?php

}
break;

default:

  if (isset ($_GET['cidr'])) { $cidr = strip_tags($_GET['cidr']); }
  if (isset ($_GET['di'])) { $di = strip_tags($_GET['di']); }

$sqllist = mysql_query("SELECT * FROM `NetMenu` ORDER BY `NetMenuCidr` + 0");
?>

<FORM action="<?php $PHPSELF;?>?mode=remove" method=post name="cidrremove">
<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0">
  <tr class="listCell">
   <TD class="listCell" colspan="3">CIDR REMOVE</TD>
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
	echo "<TD class=\"listCell\" width=\"20\"><INPUT TYPE=\"checkbox\" NAME=\"cidr[]\" VALUE=\"$row[NetMenuId]\"></td>";
	echo "<TD class=\"listCell\"> $row[NetMenuCidr]&nbsp;</td>";
	echo "<TD class=\"listCell\"> $row[NetCidrDescription]&nbsp;</TD>";
	echo "</tr>";
}
echo "</TABLE>";
echo "<input TYPE=\"Image\" src=\"i/remove.png\" onClick=\"document.cidrremove.submit();\">";
echo "</form>";

  // Use the footer function from layout.php
  footer();

} // end switch
//------------------------------------------------------------------------------------------
?>
