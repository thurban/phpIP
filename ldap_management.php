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
 if (isset ($_POST['ldap_server'])) { $ldap_server = strip_tags($_POST['ldap_server']); }
 if (isset ($_POST['ldap_port'])) { $ldap_port = strip_tags($_POST['ldap_port']); }

// Use the myheader function from layout.php
myheader("LDAP Management -- Add");

$ldap_add = mysql_query("INSERT INTO `ldap` VALUES 
        ('', '$ldap_server', '$ldap_port')");
// Redirect to ldap_management.php after sql insert
?>
  <h2><font color="FF0000">Updating Database, Please wait</font></h4>
  <meta http-equiv=Refresh content=1;url="ldap_management.php">

<?php
exit();
} //end

case "delete":
{

// Use the myheader function from layout.php
myheader("LDAP Management -- Delete");

if (isset ($_GET['lid'])) { $lid = strip_tags($_GET['lid']); }
  
  $ldap_delete = mysql_query("DELETE FROM `ldap` WHERE `ldapId` = '$lid'");

// Redirect to ldap_management.php after sql insert
?>
  <h2><font color="FF0000">Updating Database, Please wait</font></h4>
  <meta http-equiv=Refresh content=1;url="ldap_management.php">

<?php
exit();
} //end


default:

// Use the myheader function from layout.php
myheader("LDAP Management");

$ldap_count = mysql_query("SELECT * FROM `ldap` WHERE `ldapId` != 0");

if ($ldap_count  != "0") {

  echo "<table class=\"listTable\" style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\">";
  echo "<tr class=\"listCell\">&nbsp;";
  echo "<td colspan=6 class=\"listCell\">LDAP Management</td>";
  echo "<tr class=\"listHeadRow\">";
  echo "<td class=\"listCell\">&nbsp;</td>";
  echo "<td class=\"listCell\">DATA SOURCE</td>";
  echo "<td class=\"listCell\">PORT</td>";
  echo "</tr>";

$ldapl = mysql_query("SELECT * FROM `ldap`");

    while ($lrow = mysql_fetch_array($ldapl))
        {
        if ($RowClass == "listRow2") { $RowClass = "listRow1";
         }
          else
           { $RowClass = "listRow2";
        }
  echo "<tr class=\"$RowClass\">";
  echo "<td class=\"listCell\">&nbsp;<a href=\"ldap_management.php?mode=delete&lid=$lrow[ldapId]\">[Delete]</a></td>";
  echo "<td class=\"listCell\">&nbsp;$lrow[ldapConnect]</td>";
  echo "<td class=\"listCell\">&nbsp;$lrow[ldapPort]</td>";
  echo "</tr>";
    } //end loop
echo "</table>";
echo "</br>";
} // end ldap_count

?> 
<FORM action="<?php $PHPSELF;?>?mode=add" method=post name="ldapadd"> 
<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0"> 
        <TR class="listCell">
           <TD class="listCell">Lightweight Directory Access Protocol (LDAP) Management</TD>
        </TR>
        <tr class="listHeadRow">
           <TD class="listCell">ADD</TD>
        </TR>
        <tr class="listRow2">
           <TD class="listCell">Server: <INPUT name="ldap_server" value="server.example.com"> 
                                      Port: <INPUT name="ldap_port" value="389"></td>
        </tr>
</table>
<table>
<tr>
  <TD align=right><a href="javascript:document.ldapadd.submit()">[ADD]</TD>
</TR>
</center>
</table>
</FORM>

<?php

  // Use the footer function from layout.php
  footer();

} // end switch
//------------------------------------------------------------------------------------------
?>
