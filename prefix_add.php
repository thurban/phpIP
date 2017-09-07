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

require('Net/IPv4.php');

 login_check();

 admin_check();

// Use the myheader function from layout.php
myheader("phpIP Management");

switch ($_REQUEST["mode"]) {

case "add":
{

/*
/ mysql insert for prefix
*/
	if (isset ($_POST['di'])) { $di = strip_tags($_POST['di']); }
	if (isset ($_POST['cidr'])) { $cidr = strip_tags($_POST['cidr']); }
	if (isset ($_GET['cidr'])) { $cidr = strip_tags($_GET['cidr']); }
	if (isset ($_GET['di'])) { $di = strip_tags($_GET['di']); }
	if (isset ($_POST['prefix'])) { $prefix = strip_tags($_POST['prefix']); }

$net = Net_IPv4::parseAddress($cidr);
  $n = explode(".", $net->network); // parse for network address
  $b = explode(".", $net->broadcast); // parse for broadcast address
  $bit = $net->bitmask;

$i = 0;
if (count($_POST[nets]) >0)
        {
        foreach ($_POST[nets] as $NetAdd) {
		if ($bit > '24') {
	        // Greater then 24
		// loop and update view to 1 to display prefix
	        $PrefixUpdate = mysql_query("UPDATE `net_ips` SET `view` = '1' WHERE `AddressId` = '$NetAdd'");
	} else {
                // Less then 24

		// loop and get netaddress
		$PrefixSelect = mysql_query("SELECT `netaddress` FROM `net_ips` WHERE `AddressId` = '$NetAdd'");
		        while($row = mysql_fetch_array($PrefixSelect))
			{
			$Prefix = $row[netaddress];
			}
                // for loop to build third octects
                for ($g = 0; $g <= "255"; $g++)
                {
		$insertIP = mysql_query("INSERT INTO `addresses` (`ip`, `NetID`) VALUES ('$Prefix.$g', '$di')");
                } // end for loop

		// loop and update view to 1 to display prefix
	        $PrefixUpdate = mysql_query("UPDATE `net_ips` SET `view` = '1' WHERE `AddressId` = '$NetAdd'");
} // end if else


          $i++;
        }
// Redirect to add.php after sql insert
?>


  <h2><font color="FF0000">Updating Database, Please wait</font></h2>
  <meta http-equiv=Refresh content=1;url="prefix_add.php">

<?php
        }

 else {
echo "<h2><font color=\"FF0000\">No Data Selected,  Please use your browser back button to complete the form.</font></h2>";
}

} // end case
break;

case "parse":
{

	if (isset ($_POST['di'])) { $di = strip_tags($_POST['di']); }
	if (isset ($_POST['cidr'])) { $cidr = strip_tags($_POST['cidr']); }
	if (isset ($_GET['cidr'])) { $cidr = strip_tags($_GET['cidr']); }
	if (isset ($_GET['di'])) { $di = strip_tags($_GET['di']); }
	if (isset ($_POST['prefix'])) { $prefix = strip_tags($_POST['prefix']); }

$net = Net_IPv4::parseAddress($cidr);
$n = explode(".", $net->network); // parse for network address
$b = explode(".", $net->broadcast); // parse for broadcast address


$ShowPrefix = mysql_query("SELECT COUNT(*) AS NetCount FROM `net_ips` WHERE `NetCidr` = '$di' AND `view` = '0'");

?>
<FORM action="<?php $PHPSELF;?>?mode=add" method=post name="update">
<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0">
  <tr class="listCell">
   <TD class="listCell" colspan="3">PREFIX -- <?php echo $cidr; ?></TD>
  </tr>
  <tr class="listHeadRow">
   <td class="listCell">&nbsp;</td>
   <td class="listCell">IP</td>
   <td class="listCell">DESCRIPTION</td>
  </tr>
<?php

if ($NetCount < '1') {

$ListPrefix = mysql_query("SELECT * FROM `net_ips` WHERE `NetCidr` = '$di' AND `view` = '0' +0");

        while($row = mysql_fetch_array($ListPrefix))
        {
        if ($RowClass == "listRow2") { $RowClass = "listRow1";
         }
          else
           { $RowClass = "listRow2";
        }
        echo "<TR class=\"$RowClass\">";
        echo "<TD class=\"listCell\" width=\"20\"><INPUT TYPE=\"checkbox\" NAME=\"nets[]\" VALUE=\"$row[AddressId]\"></td>";
        echo "<TD class=\"listCell\">&nbsp;$row[netaddress]</TD>";
        echo "<TD class=\"listCell\">&nbsp;$row[ip_description]</TD>";
        echo "</tr>";
	}
        echo "</TABLE>";
//                echo "<TABLE>";
                        echo "<a href=\"javascript:document.update.submit()\">[ADD]</a>";
//                echo "</TABLE>";
                echo "</br>";
		echo "<input type=\"hidden\" name=\"cidr\" value=\"$cidr\">";
		echo "<input type=\"hidden\" name=\"di\" value=\"$di\">";
        echo "</form>";
  } // END IF ELSE

}
break;


default:

$sqllist = mysql_query("SELECT * FROM `NetMenu` ORDER BY `NetMenuCidr` + 0");

?>

<FORM action="<?php $PHPSELF;?>?mode=parse" method=post name="prefixadd">
<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0">
  <tr class="listCell">
   <TD class="listCell" colspan="3">PREFIX UPDATE</TD>
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
        echo "<TR class=\"$RowClass\">";
        echo "<TD class=\"listCell\" width=\"20\"><a href=\"prefix_add.php?mode=parse&cidr=$row[NetMenuCidr]&di=$row[NetMenuId]\">[Add]</a></TD>";
        echo "<TD class=\"listCell\">$row[NetMenuCidr]&nbsp;</TD>";
        echo "<TD class=\"listCell\">$row[NetCidrDescription]&nbsp;</TD>";
        echo "</tr>";
}
echo "</TABLE>";
echo "</form>";

  // Use the footer function from layout.php
  footer();

} // end switch
//------------------------------------------------------------------------------------------
?>
