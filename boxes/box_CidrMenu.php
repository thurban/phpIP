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

//including the class file
include('./classes/xPandMenu.php');

// Creating a new menu == the root of the menu `tree`
$root = new XMenu();

// Adding first level nodes

// To attach a sub node to the Root, call the function addItem()

if ($_SESSION['access_level'] != "Administrator") {
        $sql = mysql_query("SELECT * FROM `NetMenu` WHERE `groupid` = '$_SESSION[groupid]' ORDER BY `NetMenuCidr` +0 ASC");
} else {
        $sql = mysql_query("SELECT * FROM `NetMenu` ORDER BY `NetMenuCidr` +0 ASC");
}
        while($row = mysql_fetch_array($sql)){

	// build tree root
        if ($_SESSION[showCidr] == 0) {
		$row[NetMenuCidr] = &$root->addItem(new XNode("$row[NetMenuCidr]",false,"i/folderclose.gif","i/folderopen.gif"));	        
		}
        if ($_SESSION[showCidr] == 1) {
		$row[NetMenuCidr] = &$root->addItem(new XNode("$row[NetCidrDescription]",false,"i/folderclose.gif","i/folderopen.gif"));	        
		}
        if ($_SESSION[showCidr] == 2) {
		$row[NetMenuCidr] = &$root->addItem(new XNode("$row[NetMenuCidr] $row[NetCidrDescription]",false,"i/folderclose.gif","i/folderopen.gif"));	
	      }
	$sqlJoin = mysql_query("SELECT * FROM `net_ips` WHERE `view` = '1' AND `NetCidr` = '$row[NetMenuId]' ORDER BY `AddressId` +0 ASC");
        while($rowJ = mysql_fetch_array($sqlJoin)){

	// build tree node under tree root
        if ($_SESSION[showPrefix] == 0) {
		$rowJ[netaddress] = &$row[NetMenuCidr]->addItem(new XNode("$rowJ[netaddress]","display.php?range=list&iprange=$rowJ[netaddress]&netid=$rowJ[NetCidr]&filter=unalloc","i/doc.gif",false));
        }
        if ($_SESSION[showPrefix] == 1) {
		$rowJ[netaddress] = &$row[NetMenuCidr]->addItem(new XNode("$rowJ[ip_description]","display.php?range=list&iprange=$rowJ[netaddress]&netid=$rowJ[NetCidr]&filter=unalloc","i/doc.gif",false));
        }
        if ($_SESSION[showPrefix] == 2) {
		$rowJ[netaddress] = &$row[NetMenuCidr]->addItem(new XNode("$rowJ[netaddress] [$rowJ[ip_description]]","display.php?range=list&iprange=$rowJ[netaddress]&netid=$rowJ[NetCidr]&filter=unalloc","i/doc.gif",false));
        }

	} // end NetMenu sql
} // end Net_ips sql


// When the tree has been built, call the generateTree() function on the root object. This will output the HTML code
// This function doesn't take any argument.
$menu_html_code = $root->generateTree();

?>

		<div> 
			<!-- HTML CODE for my tree-view menu -->
			<?php
				echo $menu_html_code;
			?>
		</div>
</table>