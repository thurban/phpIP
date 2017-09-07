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

case "edit":
{
  if (isset ($_GET['di'])) { $di = strip_tags($_GET['di']); }

// Use the myheader function from layout.php
myheader("Selecting Group");

  echo "<FORM action='group_update.php?mode=update' method='post' name='edit'>";
  echo "<table class=\"listTable\" style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\">";
  echo "<tr class=\"tableheader\">";
  echo "<td colspan=6 class=\"listCell\">GROUP UPDATE</td>";
  echo "<tr class=\"listHeadRow\">";
  echo "<td class=\"listCell\">IP</td>";
  echo "<td class=\"listCell\">GROUP</td>";
  echo "</tr>";

$pdesc = mysql_query("SELECT * FROM `NetMenu` WHERE `NetMenuId` = '$di'");

    while ($row = mysql_fetch_array($pdesc))
        {
        if ($RowClass == "listRow2") { $RowClass = "listRow1";
        } else { $RowClass = "listRow2"; }
 		$cur_gid = $row[groupid];
  		echo "<tr class=\"$RowClass\" class=\"listCell\">";
  		echo "<td class=\"listCell\">&nbsp;$row[NetMenuCidr]<input type=\"hidden\" value=\"$di\" name=\"di\"></td>";
?>
		<td class="listCell">
		<select name="gid">
<?php
			$val = @mysql_query("SELECT * FROM groups");
			
			if (mysql_num_rows($val) > 0) 
			{
				while($row = mysql_fetch_array($val)) 
				{
					$gid = $row[id];
					$group = $row[group];
					if ($cur_gid == $gid) 
					{
						echo "<option value=$gid selected>$group</option>";
					} else {
						echo "<option value=$gid>$group</option>";
					}
				}
			}
?>
       </select>
	   </td>
<?php
  echo "</tr>";
}
echo "</table>";
echo "<table>";
  echo "<td><a href=\"javascript:document.edit.submit()\">[UPDATE]</td>";
echo "</table>";



} //end case
break;

case "update":
{
  if (isset ($_POST['di'])) { $di = strip_tags($_POST['di']); }
  if (isset ($_POST['gid'])) { $gid = strip_tags($_POST['gid']); }

// Use the myheader function from layout.php
myheader("Updating");

// Update NetMenu groupid
$updesc = mysql_query("UPDATE `NetMenu` SET `groupid` = '$gid' WHERE `NetMenuId` = '$di'");

// Update net_ips groupid
$UpNetIps  = mysql_query("UPDATE `net_ips` SET `groupid` = '$gid' WHERE `NetCidr` = '$di'");

$SelectNetIps = mysql_query("SELECT `netaddress` FROM `net_ips` WHERE `NetCidr` = $di");
	while ($row = mysql_fetch_array($SelectNetIps)) {
	$UpdateAddress = mysql_query("UPDATE `addresses` SET `groupid` = '$gid' WHERE `ip` LIKE '%$row[netaddress].%'");
}

// Redirect after sql insert
?>
  <h2><font color="FF0000">Updating Database, Please wait</font></h4>
  <meta http-equiv=Refresh content=1;url="group_update.php">

<?php
}
break;

default:

// Use the myheader function from layout.php
myheader("Group Update");

  echo "<table class=\"listTable\" style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\">";
  echo "<tr class=\"tableheader\">";
  echo "<td colspan=6 class=\"listCell\">GROUP</td>";
  echo "<tr class=\"listHeadRow\">";
  echo "<td class=\"listCell\">&nbsp;</td>";
  echo "<td class=\"listCell\">IP</td>";
  echo "<td class=\"listCell\">GROUP</td>";
  echo "</tr>";

  $pdesc = mysql_query("SELECT * FROM `NetMenu` a INNER JOIN groups b ON a.groupid = b.id ORDER BY a.NetMenuId + 0");

  while ($row = mysql_fetch_array($pdesc))
    {
      if ($RowClass == "listRow2") { $RowClass = "listRow1";  }
      else { $RowClass = "listRow2"; }
	  $cur_gid = $row[groupid];
   	  $cur_group = $row[group];
	  echo "<tr class=\"$RowClass\" class=\"listCell\">";
	  echo "<td class=\"listCell\" width=\"20\">&nbsp;<a href=\"group_update.php?mode=edit&di=$row[NetMenuId]\">[Edit]</a></td>";
	  echo "<td class=\"listCell\">&nbsp;$row[NetMenuCidr]</td>";
	  echo "<td class=\"listCell\">&nbsp;$row[group]</td>";
  	  echo "</tr>";
	}
  echo "</table>";

  // Use the footer function from layout.php
  footer();

} // end switch
//------------------------------------------------------------------------------------------
?>

