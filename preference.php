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
include 'iplayout.php';

 login_check();

switch ($_REQUEST["mode"]) {

case "update":
{
	if (isset ($_POST['showCidr'])) { $showCidr = strip_tags($_POST['showCidr']); }
	if (isset ($_POST['showPrefix'])) { $showPrefix = strip_tags($_POST['showPrefix']); }
	if (isset ($_POST['style'])) { $style = strip_tags($_POST['style']); }
	if (isset ($_POST['showDeviceData'])) { $showDeviceData = strip_tags($_POST['showDeviceData']); }
	if (isset ($_POST['sorder1'])) { $sorder1 = strip_tags($_POST['sorder1']); }
	if (isset ($_POST['sorder2'])) { $sorder2 = strip_tags($_POST['sorder2']); }
	if (isset ($_POST['sorder3'])) { $sorder3 = strip_tags($_POST['sorder3']); }
	if (isset ($_POST['sorder4'])) { $sorder4 = strip_tags($_POST['sorder4']); }
    if (isset ($_POST['resolveDNS'])) { $resolveDNS = strip_tags($_POST['resolveDNS']); }
	if (isset ($_GET['di'])) { $di = strip_tags($_GET['di']); }

// Use the myheader function from layout.php
myheader("Preference Update");

$sql_update = mysql_query("UPDATE `preference` SET `showCidr` = '$showCidr', 
				`showPrefix` = '$showPrefix', 
				`style` = '$style', 
				`sorder1` = '$sorder1', 
				`sorder2` = '$sorder2',
				`sorder3` = '$sorder3', 
				`sorder4` = '$sorder4', 
                `resolveDNS` = '$resolveDNS', 
				`showDeviceData` = '$showDeviceData' WHERE `uid` = $di ");

	// update session table with new data
              $_SESSION['showCidr'] 		= "$showCidr";
              $_SESSION['showPrefix'] 		= "$showPrefix";
              $_SESSION['style'] 		= "$style";
              $_SESSION['showDeviceData'] 	= "$showDeviceData";
              $_SESSION['sorder1'] 		= "$sorder1";
              $_SESSION['sorder2'] 		= "$sorder2";
              $_SESSION['sorder3'] 		= "$sorder3";
              $_SESSION['sorder4'] 		= "$sorder4";
              $_SESSION['resolveDNS'] 		= "$resolveDNS";
?>
  <h2><font color="FF0000">Updating Database, Please wait</font></h4>
  <meta http-equiv=Refresh content=1;url="preference.php">

<?php

exit();
} //end
break;

case "in":
{
	if (isset ($_POST['showCidr'])) { $showCidr = strip_tags($_POST['showCidr']); }
	if (isset ($_POST['showPrefix'])) { $showPrefix = strip_tags($_POST['showPrefix']); }
	if (isset ($_POST['style'])) { $style = strip_tags($_POST['style']); }
	if (isset ($_POST['showDeviceData'])) { $showDeviceData = strip_tags($_POST['showDeviceData']); }
	if (isset ($_POST['sorder1'])) { $sorder1 = strip_tags($_POST['sorder1']); }
	if (isset ($_POST['sorder2'])) { $sorder2 = strip_tags($_POST['sorder2']); }
	if (isset ($_POST['sorder3'])) { $sorder3 = strip_tags($_POST['sorder3']); }
	if (isset ($_POST['sorder4'])) { $sorder4 = strip_tags($_POST['sorder4']); }
    if (isset ($_POST['resolveDNS'])) { $resolveDNS = strip_tags($_POST['resolveDNS']); }
	if (isset ($_GET['di'])) { $di = strip_tags($_GET['di']); }

// Use the myheader function from layout.php
myheader("Preference Update");


$sql_update = mysql_query("INSERT INTO `preference` (`uid` , `showCidr` , 
			`showPrefix` , `style`, `sorder1`, `sorder2` , `sorder3`, `sorder4`, `resolveDNS`) 
			    VALUES 
				('$di', '$showCidr', '$showPrefix', '$style', '$sorder1', '$sorder2', '$sorder3', '$sorder4', '$resolveDNS')");

	// update session table with new data
              $_SESSION['showCidr'] 		= "$showCidr";
              $_SESSION['showPrefix'] 		= "$showPrefix";
              $_SESSION['style'] 		= "$style";
              $_SESSION['showDeviceData'] 	= "$showDeviceData";
              $_SESSION['sorder1'] 		= "$sorder1";
              $_SESSION['sorder2'] 		= "$sorder2";
              $_SESSION['sorder3'] 		= "$sorder3";
              $_SESSION['sorder4'] 		= "$sorder4";
              $_SESSION['resolveDNS'] 	= "$resolveDNS";
?>
  <h2><font color="FF0000">Updating Database, Please wait</font></h4>
  <meta http-equiv=Refresh content=1;url="preference.php">

<?php

exit();
} //end
break;

case "inpass":
{
	if (isset ($_POST['password'])) { $password = strip_tags($_POST['password']); }
	if (isset ($_POST['password1'])) { $password1 = strip_tags($_POST['password1']); }
	if (isset ($_GET['di'])) { $di = strip_tags($_GET['di']); }

// Use the myheader function from layout.php
myheader("Password Update");

 if ($password != $password1) {
       echo "<h2><font color=\"FF0000\">Passwords entered were not the same.  Not changed.</h2>";
    } elseif ( strlen($password)>16 || strlen($password)<6 )
       echo "<h2><font color=\"FF0000\">New password must be between 6 and 16 characters.  Try again.</h2>";
    else
    {
	$update = mysql_query("UPDATE `users` SET `password` = MD5( '$password' ) WHERE `uid` = $di");
?>
 <h2><font color="FF0000">Updating Database, Please wait</font></h4> 
 <meta http-equiv=Refresh content=1;url="preference.php"> 
<?php
}

exit();
} //end
break;


case "pass":
{
if (isset ($_GET['di'])) { $di = strip_tags($_GET['di']); }

// Use the myheader function from layout.php
myheader("Password Updated");
	echo "<form action=\"preference.php?mode=inpass&di=$di\" method=\"post\" name=\"update\">";
	echo "<TABLE class=\"listTable\" style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\">";
	echo "<TR class=\"listCell\">";
	echo "<TD colspan=\"2\" class=\"listCell\">PREFERENCE</TD></TR>";
	echo "<TR class=\"listHeadRow\">";
	echo "<TD colspan=\"2\" class=\"listCell\">Update</TD>";
	echo "<TR class=\"listRow2\">";
	echo "<TD class=\"listCell\">PASSWORD</TD>";
	echo "<TD class=\"listCell\"><INPUT type=\"password\" name=\"password\"></TD>";
	echo "</TR>";
	echo "<TR class=\"listRow1\">";
	echo "<TD class=\"listCell\">CONFIRM PASSWORD</TD>";
	echo "<TD class=\"listCell\"><INPUT type=\"password\" name=\"password1\"></TD>";
	echo "</TR>";
	echo "</table>";
	echo "<table>";
	echo "<TR>";
	echo "<TD align=right><a href=\"javascript:document.update.submit()\">[UPDATE]</TD>";
	echo "</TR>";
	echo "</table>";
	echo "</FORM>";
} //end
break;


case "edit":
{
if (isset ($_GET['di'])) { $di = strip_tags($_GET['di']); }

// Use the myheader function from layout.php
myheader("Preference");

  $pref =  mysql_query("SELECT * FROM `preference` WHERE `uid` = '$di'");
	while($row = mysql_fetch_array($pref)) {
	$showCidr 		= $row[showCidr];
	$showPrefix		= $row[showPrefix];
	$style 			= $row[style];
	$showDeviceData 	= $row[showDeviceData];
	$sorder1 		= $row[sorder1];
	$sorder2 		= $row[sorder2];
	$sorder3 		= $row[sorder3];
	$sorder4 		= $row[sorder4];
    $resolveDNS 		= $row[resolveDNS];
	}

// replace merge database name with display name
switch ($showCidr) {
            case "0":
                $sshowCidr="IP Only";
                break;
            case "1":
                $sshowCidr="Description Only";
                break;
            case "2":
                $sshowCidr="IP and Description";
                break;
}
switch ($showPrefix) {
            case "0":
                $sshowPrefix="IP Only";
                break;
            case "1":
                $sshowPrefix="Description Only";
                break;
            case "2":
                $sshowPrefix="IP and Description";
                break;
}
switch ($style) {
            case "default.css":
                $sstyle = "Original";
                break;
            case "red.css":
                $sstyle = "Red/White";
                break;
            case "white.css":
                $sstyle = "White/Black";
                break;
            case "green.css":
                $sstyle = "Green/White";
                break;
}
switch ($showDeviceData) {
            case "0":
                $sshowDeviceData="Disabled";
                break;
            case "1":
                $sshowDeviceData="Enabled";
                break;
}
switch ($resolveDNS) {
            case "0":
                $rresolveDNS="Disabled";
                break;
            case "1":
                $rresolveDNS="Enabled";
                break;
}
switch ($sorder1) {
            case "ip":
                $order1="IP";
                break;
            case "mask":
                $order1="Mask";
                break;                
            case "description":
                $order1="Description";
                break;       
            case "client":
                $order1="Client";
                break;                
            case "phone":
                $order1="Phone";
                break;                
            case "email":
                $order1="Email";
                break;                
            case "notes":
                $order1="Notes";
                break; 
            case "clientcontact":
                $order1="Client Contact";
                break;
            case "deviceType":
                $order1="Device Type";
                break;
            case "deviceLocation":
                $order1="Device Location";
                break;
            case "deviceOwner":
                $order1="Device Owner";
                break;
            case "deviceManufacturer":
                $order1="Device Manufacturer";
                break;
            case "deviceModel":
                $order1="Device Model";
                break;
            case "deviceCustom1":
                $order1="Device Custom 1";
                break;
            case "deviceCustom2":
                $order1="Device Custom 2";
                break;
            case "deviceCustom3":
                $order1="Device Custom 3";
                break;
            default: $order1 = $sorder1;
                break;
}
switch ($sorder2) {
            case "ip":
                $order2="IP";
                break;
            case "mask":
                $order2="Mask";
                break;                
            case "description":
                $order2="Description";
                break;       
            case "client":
                $order2="Client";
                break;                
            case "phone":
                $order2="Phone";
                break;                
            case "email":
                $order2="Email";
                break;                
            case "notes":
                $order2="Notes";
                break;       
            case "clientcontact":
                $order2="Client Contact";
                break;
            case "deviceType":
                $order2="Device Type";
                break;
            case "deviceLocation":
                $order2="Device Location";
                break;
            case "deviceOwner":
                $order2="Device Owner";
                break;
            case "deviceManufacturer":
                $order2="Device Manufacturer";
                break;
            case "deviceModel":
                $order2="Device Model";
                break;
            case "deviceCustom1":
                $order2="Device Custom 1";
                break;
            case "deviceCustom2":
                $order2="Device Custom 2";
                break;
            case "deviceCustom3":
                $order2="Device Custom 3";
                break;
            default: $order2 = $sorder2;
                break;
}
switch ($sorder3) {
            case "ip":
                $order3="IP";
                break;
            case "mask":
                $order3="Mask";
                break;                
            case "description":
                $order3="Description";
                break;       
            case "client":
                $order3="Client";
                break;                
            case "phone":
                $order3="Phone";
                break;                
            case "email":
                $order3="Email";
                break;                
            case "notes":
                $order3="Notes";
                break;       
            case "clientcontact":
                $order3="Client Contact";
                break;
            case "deviceType":
                $order3="Device Type";
                break;
            case "deviceLocation":
                $order3="Device Location";
                break;
            case "deviceOwner":
                $order3="Device Owner";
                break;
            case "deviceManufacturer":
                $order3="Device Manufacturer";
                break;
            case "deviceModel":
                $order3="Device Model";
                break;
            case "deviceCustom1":
                $order3="Device Custom 1";
                break;
            case "deviceCustom2":
                $order3="Device Custom 2";
                break;
            case "deviceCustom3":
                $order3="Device Custom 3";
                break;
            default: $order3 = $sorder3;
                break;
}
switch ($sorder4) {
            case "ip":
                $order4="IP";
                break;
            case "mask":
                $order4="Mask";
                break;                
            case "description":
                $order4="Description";
                break;       
            case "client":
                $order4="Client";
                break;                
            case "phone":
                $order4="Phone";
                break;                
            case "email":
                $order4="Email";
                break;                
            case "notes":
                $order4="Notes";
                break;       
            case "clientcontact":
                $order4="Client Contact";
                break;
            case "deviceType":
                $order4="Device Type";
                break;
            case "deviceLocation":
                $order4="Device Location";
                break;
            case "deviceOwner":
                $order4="Device Owner";
                break;
            case "deviceManufacturer":
                $order4="Device Manufacturer";
                break;
            case "deviceModel":
                $order4="Device Model";
                break;
            case "deviceCustom1":
                $order4="Device Custom 1";
                break;
            case "deviceCustom2":
                $order4="Device Custom 2";
                break;
            case "deviceCustom3":
                $order4="Device Custom 3";
                break;
            default: $order4 = $sorder4;
                break;
}

?>

<form action="preference.php?mode=update&di=<?php echo $di;?>" method="post" name="update">
<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0">
  <TR class="listCell">
    <TD colspan="2" class="listCell">PREFERENCE</TD></TR>
  <tr class="listHeadRow">
    <TD colspan="2" class="listCell">UPDATE</TD></TR>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">SHOW CIDR</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="showCidr">
                          <option value="<?php echo $showCidr; ?>" SELECTED><?php echo $sshowCidr; ?></option>
                          <option value="0">---------------</option>
                          <option value="0">IP Only</option>
                          <option value="1">Description Only</option>
                          <option value="2">IP and Description</option>
                        </select></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">SHOW PREFIX</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="showPrefix">
                          <option value="<?php echo $showPrefix; ?>" SELECTED><?php echo $sshowPrefix; ?></option>
                          <option value="0">---------------</option>
                          <option value="0">IP Only</option>
                          <option value="1">Description Only</option>
                          <option value="2">IP and Description</option>
                        </select></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">THEME / STYLE</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="style">
                          <option value="<?php echo $style; ?>" SELECTED><?php echo $sstyle; ?></option>
                          <option value="default.css">---------------</option>
                          <option value="default.css">Original</option>
                          <option value="red.css">Red/White</option>
                          <option value="white.css">White/Black</option>
                          <option value="green.css">Green/White</option>
                        </select></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">SHOW DEVICE DATA</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="showDeviceData">
                          <option value="<?php echo $showDeviceData; ?>" SELECTED><?php echo $sshowDeviceData; ?></option>
                          <option value="0">---------------</option>
                          <option value="0">Disabled</option>
                          <option value="1">Enabled</option>
                        </select></TD>
  </TR>
   <TR class="listRow2">
    <TD class="listCell">RESOLVE HOSTNAMES</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="resolveDNS">
                          <option value="<?php echo $resolveDNS; ?>" SELECTED><?php echo $rresolveDNS; ?></option>
                          <option value="0">---------------</option>
                          <option value="0">Disabled</option>
                          <option value="1">Enabled</option>
                        </select></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">DISPLAY ORDER 1</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="sorder1">
                          <option value="<?php echo $sorder1; ?>" selected><?php echo $order1; ?></option>
                          <option value="ip">---------------</option>
                          <option value="ip">IP</option>
                          <option value="mask">Mask</option>
                          <option value="description">Description</option>
                          <option value="client">Client</option>
                          <option value="clientcontact">Client Contact</option>
                          <option value="phone">Phone Number</option>
                          <option value="email">Email Address</option>
                        </select></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DISPLAY ORDER 2</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="sorder2">
                          <option value="<?php echo $sorder2; ?>" selected><?php echo $order2; ?></option>
                          <option value="mask">---------------</option>
                          <option value="ip">IP</option>
                          <option value="mask">Mask</option>
                          <option value="description">Description</option>
                          <option value="client">Client</option>
                          <option value="clientcontact">Client Contact</option>
                          <option value="phone">Phone Number</option>
                          <option value="email">Email Address</option>
                          <option value="deviceType">Device Type</option>
                          <option value="deviceLocation">Device Location</option>
                          <option value="deviceOwner">Device Owner</option>
                          <option value="deviceuManufacturer">Device Manufacturer</option>
                          <option value="deviceModel">Device Model</option>
                          <option value="deviceCustom1">Device Custom 1</option>
                          <option value="deviceCustom2">Device Custom 2</option>
                          <option value="deviceCustom3">Device Custom 3</option>
                        </select></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">DISPLAY ORDER 3</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="sorder3">
                          <option value="<?php echo $sorder3; ?>" selected><?php echo $order3; ?></option>
                          <option value="description">---------------</option>
                          <option value="ip">IP</option>
                          <option value="mask">Mask</option>
                          <option value="description">Description</option>
                          <option value="client">Client</option>
                          <option value="clientcontact">Client Contact</option>
                          <option value="phone">Phone Number</option>
                          <option value="email">Email Address</option>
                          <option value="deviceType">Device Type</option>
                          <option value="deviceLocation">Device Location</option>
                          <option value="deviceOwner">Device Owner</option>
                          <option value="deviceManufacturer">Device Manufacturer</option>
                          <option value="deviceModel">Device Model</option>
                          <option value="deviceCustom1">Device Custom 1</option>
                          <option value="deviceCustom2">Device Custom 2</option>
                          <option value="deviceCustom3">Device Custom 3</option>
                        </select></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DISPLAY ORDER 4</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="sorder4">
                          <option value="<?php echo $sorder4; ?>" selected><?php echo $order4; ?></option>
                          <option value="client">---------------</option>
                          <option value="ip">IP</option>
                          <option value="mask">Mask</option>
                          <option value="description">Description</option>
                          <option value="client">Client</option>
                          <option value="clientcontact">Client Contact</option>
                          <option value="phone">Phone Number</option>
                          <option value="email">Email Address</option>
                          <option value="deviceType">Device Type</option>
                          <option value="deviceLocation">Device Location</option>
                          <option value="deviceOwner">Device Owner</option>
                          <option value="deviceManufacturer">Device Manufacturer</option>
                          <option value="deviceModel">Device Model</option>
                          <option value="deviceCustom1">Device Custom 1</option>
                          <option value="deviceCustom2">Device Custom 2</option>
                          <option value="deviceCustom3">Device Custom 3</option>
                        </select></TD>
  </TR>
<table>
<tr>
  <TD align=right><a href="javascript:document.update.submit()">[UPDATE]</TD>
</TR>
</table>
</FORM>

<?php
 
} //end
break;

case "create":
{
if (isset ($_GET['di'])) { $di = strip_tags($_GET['di']); }

// Use the myheader function from layout.php
myheader("Preference");

?>

<form action="preference.php?mode=in&di=<?php echo $di;?>" method="post" name="update">
<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0">
  <TR class="listCell">
    <TD colspan="2" class="listCell">PREFERENCE</TD></TR>
  <tr class="listHeadRow">
    <TD colspan="2" class="listCell">UPDATE</TD></TR>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">SHOW CIDR</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="showCidr">
                          <option value="0">---------------</option>
                          <option value="0" SELECTED>IP Only</option>
                          <option value="1">Description Only</option>
                          <option value="2">IP and Description</option>
                        </select></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">SHOW PREFIX</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="showPrefix">
                          <option value="0">---------------</option>
                          <option value="0">IP Only</option>
                          <option value="1">Description Only</option>
                          <option value="2" SELECTED>IP and Description</option>
                        </select></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">THEME / STYLE</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="style">
                          <option value="default.css">---------------</option>
                          <option value="default.css" SELECTED>Original</option>
                          <option value="red.css">Red/White</option>
                          <option value="white.css">White/Black</option>
                          <option value="green.css">Green/White</option>
                        </select></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">SHOW DEVICE DATA</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="showDeviceData">
                          <option value="0">---------------</option>
                          <option value="0" SELECTED>Disabled</option>
                          <option value="1">Enabled</option>
                        </select></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">RESOLVE HOSTNAMES</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="resolveDNS">
                          <option value="0">---------------</option>
                          <option value="0" SELECTED>Disabled</option>
                          <option value="1">Enabled</option>
                        </select></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">DISPLAY ORDER 1</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="sorder1">
                          <option value="ip">---------------</option>
                          <option value="ip" SELECTED>IP</option>
                          <option value="mask">Mask</option>
                          <option value="description">Description</option>
                          <option value="client">Client</option>
                          <option value="clientcontact">Client Contact</option>
                          <option value="phone">Phone Number</option>
                          <option value="email">Email Address</option>
                          <option value="deviceType">Device Type</option>
                        </select></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DISPLAY ORDER 2</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="sorder2">
                          <option value="mask">---------------</option>
                          <option value="ip">IP</option>
                          <option value="mask" SELECTED>Mask</option>
                          <option value="description">Description</option>
                          <option value="client">Client</option>
                          <option value="clientcontact">Client Contact</option>
                          <option value="phone">Phone Number</option>
                          <option value="email">Email Address</option>
                          <option value="deviceLocation">Device Location</option>
                          <option value="deviceOwner">Device Owner</option>
                          <option value="deviceuManfacturer">Device Manufacturer</option>
                          <option value="deviceModel">Device Model</option>
                          <option value="deviceCustom1">Device Custom 1</option>
                          <option value="deviceCustom2">Device Custom 2</option>
                          <option value="deviceCustom3">Device Custom 3</option>
                        </select></TD>
  </TR>
  <TR class="listRow1">
    <TD class="listCell">DISPLAY ORDER 3</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="sorder3">
                          <option value="description" SELECTED>---------------</option>
                          <option value="ip">IP</option>
                          <option value="mask">Mask</option>
                          <option value="description" SELECTED>Description</option>
                          <option value="client">Client</option>
                          <option value="clientcontact">Client Contact</option>
                          <option value="phone">Phone Number</option>
                          <option value="email">Email Address</option>
                          <option value="deviceLocation">Device Location</option>
                          <option value="deviceOwner">Device Owner</option>
                          <option value="deviceManufacturer">Device Manufacturer</option>
                          <option value="deviceModel">Device Model</option>
                          <option value="deviceCustom1">Device Custom 1</option>
                          <option value="deviceCustom2">Device Custom 2</option>
                          <option value="deviceCustom3">Device Custom 3</option>
                        </select></TD>
  </TR>
  <TR class="listRow2">
    <TD class="listCell">DISPLAY ORDER 4</TD>
    <TD class="listCell">&nbsp;
			<select size="1" name="sorder4">
                          <option value="client">---------------</option>
                          <option value="ip">IP</option>
                          <option value="mask">Mask</option>
                          <option value="description">Description</option>
                          <option value="client" SELECTED>Client</option>
                          <option value="clientcontact">Client Contact</option>
                          <option value="phone">Phone Number</option>
                          <option value="email">Email Address</option>
                          <option value="deviceLocation">Device Location</option>
                          <option value="deviceOwner">Device Owner</option>
                          <option value="deviceManufacturer">Device Manufacturer</option>
                          <option value="deviceModel">Device Model</option>
                          <option value="deviceCustom1">Device Custom 1</option>
                          <option value="deviceCustom2">Device Custom 2</option>
                          <option value="deviceCustom3">Device Custom 3</option>
                        </select></TD>
  </TR>
<table>
<tr>
  <TD align=right><a href="javascript:document.update.submit()">[UPDATE]</TD>
</TR>
</center>
</table>
</FORM>

<?php
 
} //end
break;


default:

// Use the myheader function from layout.php
myheader("Preference");

  echo "<table class=\"listTable\" style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\">";
  echo "<tr class=\"tableheader\">";
  echo "<td colspan=\"2\" class=\"listCell\">PREFERENCE SET</td>";
  echo "<tr class=\"listHeadRow\">";
  echo "<td class=\"listCell\">OPTION</td>";
  echo "<td class=\"listCell\">SET VALUE</td>";
  echo "</tr>";


$sus = mysql_query("SELECT `uid` FROM `users` WHERE `username` = '$_SESSION[username]'");
	while($row = mysql_fetch_array($sus)) {	
	$uid = $row[uid];
	}

$pref =  mysql_query("SELECT * FROM `preference` WHERE `uid` = '$uid'");
    while ($row = mysql_fetch_array($pref))
        {
	$uid	= $row[uid];
        $showCidr = $row[showCidr];
        $showPrefix = $row[showPrefix];
        $style = $row[style];
        $showDeviceData = $row[showDeviceData];
        $sorder1 = $row[sorder1];
        $sorder2 = $row[sorder2];
        $sorder3 = $row[sorder3];
        $sorder4 = $row[sorder4];
        $resolveDNS = $row[resolveDNS];
        }

// replace merge database name with display name
switch ($showCidr) {
            case "0":
                $sshowCidr="IP Only";
                break;
            case "1":
                $sshowCidr="Description Only";
                break;
            case "2":
                $sshowCidr="IP and Description";
                break;
}
switch ($showPrefix) {
            case "0":
                $sshowPrefix="IP Only";
                break;
            case "1":
                $sshowPrefix="Description Only";
                break;
            case "2":
                $sshowPrefix="IP and Description";
                break;
}
switch ($style) {
            case "default.css":
                $sstyle = "Original";
                break;
            case "red.css":
                $sstyle = "Red/White";
                break;
            case "white.css":
                $sstyle = "White/Black";
                break;
            case "green.css":
                $sstyle = "Green/White";
                break;
}
switch ($showDeviceData) {
            case "0":
                $sshowDeviceData="Disabled";
                break;
            case "1":
                $sshowDeviceData="Enabled";
                break;
}
switch ($resolveDNS) {
            case "0":
                $rresolveDNS="Disabled";
                break;
            case "1":
                $rresolveDNS="Enabled";
                break;
}switch ($sorder1) {
            case "ip":
                $order1="IP";
                break;
            case "mask":
                $order1="Mask";
                break;                
            case "description":
                $order1="Description";
                break;       
            case "client":
                $order1="Client";
                break;                
            case "phone":
                $order1="Phone";
                break;                
            case "email":
                $order1="Email";
                break;                
            case "notes":
                $order1="Notes";
                break;       
            case "clientcontact":
                $order1="Client Contact";
                break;
            case "deviceType":
                $order1="Device Type";
                break;
            case "deviceLocation":
                $order1="Device Location";
                break;
            case "deviceOwner":
                $order1="Device Owner";
                break;
            case "deviceManufacturer":
                $order1="Device Manufacturer";
                break;
            case "deviceModel":
                $order1="Device Model";
                break;
            case "deviceCustom1":
                $order1="Device Custom 1";
                break;
            case "deviceCustom2":
                $order1="Device Custom 2";
                break;
            case "deviceCustom3":
                $order1="Device Custom 3";
                break;
            default: $order1 = $sorder1;
                break;
}
switch ($sorder2) {
            case "ip":
                $order2="IP";
                break;
            case "mask":
                $order2="Mask";
                break;                
            case "description":
                $order2="Description";
                break;       
            case "client":
                $order2="Client";
                break;                
            case "phone":
                $order2="Phone";
                break;                
            case "email":
                $order2="Email";
                break;                
            case "notes":
                $order2="Notes";
                break;       
            case "clientcontact":
                $order2="Client Contact";
                break;
            case "deviceType":
                $order2="Device Type";
                break;
            case "deviceLocation":
                $order2="Device Location";
                break;
            case "deviceOwner":
                $order2="Device Owner";
                break;
            case "deviceManufacturer":
                $order2="Device Manufacturer";
                break;
            case "deviceModel":
                $order2="Device Model";
                break;
            case "deviceCustom1":
                $order2="Device Custom 1";
                break;
            case "deviceCustom2":
                $order2="Device Custom 2";
                break;
            case "deviceCustom3":
                $order2="Device Custom 3";
                break;
            default: $order2 = $sorder2;
                break;
}
switch ($sorder3) {
            case "ip":
                $order3="IP";
                break;
            case "mask":
                $order3="Mask";
                break;                
            case "description":
                $order3="Description";
                break;       
            case "client":
                $order3="Client";
                break;                
            case "phone":
                $order3="Phone";
                break;                
            case "email":
                $order3="Email";
                break;                
            case "notes":
                $order3="Notes";
                break;       
            case "clientcontact":
                $order3="Client Contact";
                break;
            case "deviceType":
                $order3="Device Type";
                break;
            case "deviceLocation":
                $order3="Device Location";
                break;
            case "deviceOwner":
                $order3="Device Owner";
                break;
            case "deviceManufacturer":
                $order3="Device Manufacturer";
                break;
            case "deviceModel":
                $order3="Device Model";
                break;
            case "deviceCustom1":
                $order3="Device Custom 1";
                break;
            case "deviceCustom2":
                $order3="Device Custom 2";
                break;
            case "deviceCustom3":
                $order3="Device Custom 3";
                break;
            default: $order3 = $sorder3;
                break;
}
switch ($sorder4) {
            case "ip":
                $order4="IP";
                break;
            case "mask":
                $order4="Mask";
                break;                
            case "description":
                $order4="Description";
                break;       
            case "client":
                $order4="Client";
                break;                
            case "phone":
                $order4="Phone";
                break;                
            case "email":
                $order4="Email";
                break;                
            case "notes":
                $order4="Notes";
                break;       
            case "clientcontact":
                $order4="Client Contact";
                break;
            case "deviceType":
                $order4="Device Type";
                break;
            case "deviceLocation":
                $order4="Device Location";
                break;
            case "deviceOwner":
                $order4="Device Owner";
                break;
            case "deviceManufacturer":
                $order4="Device Manufacturer";
                break;
            case "deviceModel":
                $order4="Device Model";
                break;
            case "deviceCustom1":
                $order4="Device Custom 1";
                break;
            case "deviceCustom2":
                $order4="Device Custom 2";
                break;
            case "deviceCustom3":
                $order4="Device Custom 3";
                break;
            default: $order4 = $sorder4;
                break;
}

  echo "<tr class=\"listRow2\">";
  echo "<td class=\"listCell\">SHOW CIDR</td>";
  echo "<td class=\"listCell\">&nbsp;$sshowCidr</td>";
  echo "</td>";

  echo "<tr class=\"listRow1\">";
  echo "<td class=\"listCell\">SHOW PREFIX</td>";
  echo "<td class=\"listCell\">&nbsp;$sshowPrefix</td>";
  echo "</td>";

  echo "<tr class=\"listRow2\">";
  echo "<td class=\"listCell\">THEME / STYLE</td>";
  echo "<td class=\"listCell\">&nbsp;$sstyle</td>";
  echo "</td>";

  echo "<tr class=\"listRow1\">";
  echo "<td class=\"listCell\">DISPLAY DEVICE DATA</td>";
  echo "<td class=\"listCell\">&nbsp;$sshowDeviceData</td>";
  echo "</td>";

  echo "<tr class=\"listRow2\">";
  echo "<td class=\"listCell\">RESOLVE HOSTNAMES</td>";
  echo "<td class=\"listCell\">&nbsp;$rresolveDNS</td>";
  echo "</td>";

  echo "<tr class=\"listRow1\">";
  echo "<td class=\"listCell\">DISPLAY ORDER 1</td>";
  echo "<td class=\"listCell\">&nbsp;$order1</td>";
  echo "</td>";

  echo "<tr class=\"listRow2\">";
  echo "<td class=\"listCell\">DISPLAY ORDER 2</td>";
  echo "<td class=\"listCell\">&nbsp;$order2</td>";
  echo "</td>";

  echo "<tr class=\"listRow1\">";
  echo "<td class=\"listCell\">DISPLAY ORDER 3</td>";
  echo "<td class=\"listCell\">&nbsp;$order3</td>";
  echo "</tr>";

  echo "<tr class=\"listRow2\">";
  echo "<td class=\"listCell\">DISPLAY ORDER 4</td>";
  echo "<td class=\"listCell\">&nbsp;$order4</td>";
  echo "</tr>";
  
  echo "</table>";
  echo "<table>";
	if (mysql_num_rows($pref) == 0) {
	  echo "<td><a href=\"preference.php?mode=create&di=$uid\">[CREATE]</a></td>";
	}
	else {
	  echo "<td><a href=\"preference.php?mode=edit&di=$uid\">[EDIT]</a></td>";
	}
  echo "</table>";
  echo "</form>";

  $passwd = mysql_query("SELECT `type` FROM `users` WHERE `uid` = '$uid'");
    while ($row = mysql_fetch_array($passwd)) {
        if ($row[type] == local) {

  echo "</br>";
  echo "</br>";
  echo "<table class=\"listTable\" style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\">";
  echo "<tr class=\"tableheader\">";
  echo "<td colspan=2 class=\"listCell\">PASSWORD CHANGE</td>";
  echo "<tr class=\"listHeadRow\">";
  echo "<td class=\"listCell\">CHANGE PASSWORD</td>";
  echo "</tr>";
          echo "<td class=\"listCell\" width=\"20\">&nbsp;<a href=\"preference.php?mode=pass&di=$uid\">[Edit]</a></td>";
        }
    }
  echo "</table>";


  // Use the footer function from layout.php
  footer();

} // end switch
//------------------------------------------------------------------------------------------
?>
