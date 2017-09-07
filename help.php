<?php
/*
+-------------------------------------------------------------------------+
| Copyright (C) 200 Michael Earls                                        |
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
include 'helplayout.php';


 login_check();

switch($_REQUEST['topic'])
// begin Case
{

   case "logout":

   break;

   default:
      myheader("User Guide");

  echo "<center><h1>Please select from the navigation menu located on the left side.</center></h1>";

  footer();

   break;

// end Case
}
?>
