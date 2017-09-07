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

case "show":
{
 if (isset ($_POST['filter_address_type'])) { $filter_address_type = strip_tags($_POST['filter_address_type']); }
 if (isset ($_POST['message_filter_type'])) { $message_filter_type = strip_tags($_POST['message_filter_type']); }
 if (isset ($_POST['content'])) { $content = strip_tags($_POST['content']); }

// Use the myheader function from layout.php
myheader("Search Results");


$sorder1 = $_SESSION['sorder1'];
$sorder2 = $_SESSION['sorder2'];
$sorder3 = $_SESSION['sorder3'];
$sorder4 = $_SESSION['sorder4'];

// replace merge database name with display name
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

switch ($message_filter_type) {
          case "casenotoneormorewords":
                $not="NOT";
          case "caseoneormorewords":
                $filter = "$not ( ($filter_address_type LIKE \"%".ereg_replace(" ","%\") OR ($filter_address_type LIKE \"%", $content)."%\") )";
                break;

          case "casenotthestring":
                $not="NOT";
          case "casethestring":
                $filter = "( ($filter_address_type $not LIKE \"%".stripslashes($content)."%\") )";
                break;
        }

	$listSearch = mysql_query("SELECT * FROM `addresses` WHERE $filter and `groupid` = '$_SESSION[groupid]'");

     echo "<table class=\"listTable\" style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\">";
     echo "<tr class=\"listCell\">";
     echo "<td colspan=\"5\" class=\"listCell\">RESULTS</td>";
     echo "</tr>";
     echo "<tr class=\"listHeadRow\">";
     echo "<td align=center>&nbsp;&nbsp;</td>";
     echo "<td align=center class=\"listCell\">".strtoupper($order1)."</td>";
     echo "<td align=center class=\"listCell\">".strtoupper($order2)."</td>";
     echo "<td align=center class=\"listCell\">".strtoupper($order3)."</td>";
     echo "<td align=center class=\"listCell\">".strtoupper($order4)."</td>";
     echo "</tr>";

    while ($row = mysql_fetch_array($listSearch))
        {
        if ($RowClass == "listRow2") { $RowClass = "listRow1";
         }
          else
           { $RowClass = "listRow2";
        }
	
	// explode netaddress

//echo "SELECT `netaddress` FROM `net_ips` WHERE `netaddress` LIKE ('%$row[ip]%') AND `view` = 1 AND `NetCidr` = $row[NetID]";
//$NetSearch = mysql_query("SELECT `netaddress` FROM `net_ips` WHERE `netaddress` LIKE ('%$row[ip]%') AND `view` = 1 AND `NetCidr` = $row[NetID]");
//    while ($row = mysql_fetch_array($listSearch))
//	{
//	$iprangeEx = explode('.', $row[netaddress]);
//	}
	$iprangeEx = explode('.', $row[ip]);

    echo "<tr class=\"$RowClass\">";
    echo "<td class=\"listCell\" width=\"50\"><a href=\"display.php?range=view&iprange=$iprangeEx[0].$iprangeEx[1].$iprangeEx[2]&netid=$row[NetID]&id=$row[id]\">[Details]</a>";

    if ($_SESSION['access_level'] == "Administrator" || $_SESSION['access_level'] == "Operator") {
        echo "&nbsp;<a href=\"display.php?range=edit&iprange=$iprangeEx[0].$iprangeEx[1].$iprangeEx[2]&netid=$netid&id=$row[id]\">[Edit]</a></td>";
    }
	echo "<td class=\"listCell\">&nbsp;$row[$sorder1]</td>";
	echo "<td class=\"listCell\">&nbsp;$row[$sorder2]</td>";
	echo "<td class=\"listCell\">&nbsp;$row[$sorder3]</td>";
	echo "<td class=\"listCell\">&nbsp;$row[$sorder4]</td>";
	echo "</tr>";
    } //end loop

echo "</table>";

// Use the footer function from layout.php
footer();
}
break;

default:

myheader("Search IP Database");

?>
<FORM action="<?php $PHPSELF;?>?mode=show" method=post name="ldapadd"> 
<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0"> 
        <TR class="listCell">
           <TD class="listCell">SEARCH IP DATABASE</TD>
        </TR>
        <tr class="listHeadRow">
           <TD class="listCell">SEARCH</TD>
        </TR>
        <tr class="listRow2">
           <TD class="listCell">
       <select class="Controle" name="filter_address_type" id="filter_address_type">
          <option value="ip" >IP</option>
          <option value="mask" >Mask</option>
          <option value="description" >Description</option>
          <option value="client" >Client</option>
          <option value="clientcontact" >Client Contact</option>
          <option value="phone" >Phone</option>
          <option value="email" >Email</option>
          <option value="notes" >Notes</option>
          <option value="deviceType" >Device Type</option>
          <option value="deviceLaction" >Device Location</option>
          <option value="deviceOwner" >Device Owner</option>
          <option value="deviceManufacture" >Device Manufacture</option>
          <option value="deviceModel" >Device Model</option>
          <option value="deviceCustom1" >Device Custom 1</option>
          <option value="deviceCustom2" >Device Custom 2</option>
          <option value="deviceCustom3" >Device Custom 3</option>
      </select>
       <select class="Controle" name="message_filter_type" id="message_filter_type">
          <option value="casethestring" >contains the string</option>
          <option value="caseoneormorewords" selected>contains one or more words</option>
          <option value="casenotthestring" >do not contains the string</option>
          <option value="casenotoneormorewords" >do not contains one or more words</option>
      </select>
        </TD>
        </tr>
    <tr class="listRow1">
     <TD class="listCell">
        Value  &nbsp; <INPUT name="content" value=""></td>
        </tr>
</table>
<table>
<tr>
  <TD align=right><a href="javascript:document.ldapadd.submit()">[SEARCH]</TD>
</TR>
</table>
</FORM>
<?php

  // Use the footer function from layout.php
  footer();
}
?>
