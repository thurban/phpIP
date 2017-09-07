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
include 'defaultlayout.php';

 login_check();


switch($_REQUEST['req']){
   case "logout":
      session_destroy();
      header("Location: logout.php?req=loggedout");
   break;

   case "loggedout":
        header("Location: login.php");
      footer();
   break;

   default:
      myheader("Logout");
?>
</br>
<table align="center">
        <tr>
                <td><h2>Are You Sure you want to logout?</h2></td>
        </tr>
        <tr>
                <td><a href="logout.php?req=logout">Yes</a> |  <a href="javascript:history.back()">No</a></td>
        </tr>
</table>
<?php
      footer();
   break;
}
?>
