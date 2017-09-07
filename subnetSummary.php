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

// Use the myheader function from layout.php
myheader("Subnet Summary");

// get count of netaddress for for loop 
$NetCount_sql = mysql_query("SELECT COUNT(*) AS NetCount FROM `net_ips` WHERE `view` = '1'");
        while($row = mysql_fetch_array($NetCount_sql)) {
                $NetCount = $row[NetCount];
        }
        // need to subtract 1 from total
        $NetCount = ($NetCount - 1);

// loop net_ips for netaddress
$NetListView = mysql_query("SELECT `netaddress`, `NetCidr` FROM `net_ips` WHERE `view` = '1'");
        while($row = mysql_fetch_array($NetListView)) {

$iprangeEx = explode('.', $row[netaddress]);

// grab total number of address based on prefixes (netaddress) 
$NetTotal_sql = mysql_query("SELECT COUNT(*) AS NetTotal FROM `addresses` WHERE `ip` 
                                LIKE '%$iprangeEx[0].$iprangeEx[1].$iprangeEx[2].%' AND `NetID` = '$row[NetCidr]'");

// grab used number of address based on prefixes (netaddress)
$NetUsed_sql = mysql_query("SELECT COUNT(*) AS Used FROM `addresses` WHERE `ip` 
                                LIKE '%$iprangeEx[0].$iprangeEx[1].$iprangeEx[2].%' AND `NetID` = '$row[NetCidr]' AND `client` IS NOT NULL");
        while($row = mysql_fetch_array($NetTotal_sql)) {
                $TotalValue[] = $row[NetTotal];
        }
        while($row = mysql_fetch_array($NetUsed_sql)) {
                $NetUsed[] = $row[Used];
        }
}

?>
<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0">
  <tr class="listCell">
   <TD class="listCell" colspan="3">PREFIX SUMMARY</TD>
  </tr>
  <tr class="listHeadRow">
   <TD class="listCell">PREFIX</TD>
   <TD class="listCell">&nbsp;</TD>
   <TD class="listCell">USED/TOTAL</TD>
  </tr>
<?php
$NetDisplay_sql = mysql_query("SELECT `netaddress` FROM `net_ips` WHERE `view` = '1'");

for ($i = 0; $i <= $NetCount;  $i++) {
        $row = mysql_fetch_array($NetDisplay_sql);
        if ($RowClass == "listRow2") { $RowClass = "listRow1";
         }
          else
           { $RowClass = "listRow2";
              }
              echo "<TR class=\"$RowClass\">";
                echo "<TD class=\"listCell\"><b>$row[netaddress]</b></TD>";
                echo "<TD class=\"listCell\" width=\"256\"><img src='i/4.gif' height='10' width='$NetUsed[$i]'></TD>";
                echo "<TD class=\"listCell\">$NetUsed[$i]/$TotalValue[$i]</TD>";
                echo "</TR>";
}
echo "</TABLE>";

  // Use the footer function from layout.php
  footer();

?>