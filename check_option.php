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

/*
Our php.ini contains the following settings:

display_errors = On
register_globals = Off
post_max_size = 8M
*/

// include the layout file
include 'layout.php';

// Use the myheader function from layout.php
myheader("phpIP Management");

?>
<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0">
  <tr class="listCell">
   <TD class="listCell" colspan="3">Recommended Settings</TD>
  </tr>
  <tr class="listHeadRow">
   <TD class="listCell" colspan="3">Select Prefix</TD>
  </tr>

<?php
echo "<TR class=\"listCell\">";
echo "<TD class=\"listCell\">DIRECTIVE</TD>";
echo "<TD class=\"listCell\">RECOMMENDED</TD>";
echo "<TD class=\"listCell\">Actual</TD>";
echo "</TR>";
echo "<TR class=\"listCell\">";
echo "<TD class=\"listCell\">Safe Mode:</TD>";
echo "<TD class=\"listCell\">&nbsp;OFF</TD>";
echo "<TD class=\"listCell\">&nbsp;".ini_get('safe_mode')."</TD>";
echo "</TR>";
echo "<TR class=\"listCell\">";
echo "<TD class=\"listCell\">Display Errors:</TD>";
echo "<TD class=\"listCell\">&nbsp;ON</TD>";
echo "<TD class=\"listCell\">&nbsp;".ini_get('display_errors')."</TD>";
echo "</TR>";
echo "<TR class=\"listCell\">";
echo "<TD class=\"listCell\">Magic Quotes GPC:</TD>";
echo "<TD class=\"listCell\">&nbsp;ON</TD>";
echo "<TD class=\"listCell\">&nbsp;".ini_get('magic_quotes_gpc')."</TD>";
echo "</TR>";
echo "<TR class=\"listCell\">";
echo "<TD class=\"listCell\">Magic Quotes Runtime:</TD>";
echo "<TD class=\"listCell\">&nbsp;OFF</TD>";
echo "<TD class=\"listCell\">&nbsp;".ini_get('magic_quotes_runtime')."</TD>";
echo "</TR>";
echo "<TR class=\"listCell\">";
echo "<TD class=\"listCell\">Register Globals:</TD>";
echo "<TD class=\"listCell\">&nbsp;OFF</TD>";
echo "<TD class=\"listCell\">&nbsp;".ini_get('register_globals')."</TD>";
echo "</TR>";
echo "<TR class=\"listCell\">";
echo "<TD class=\"listCell\">Output Buffering:</TD>";
echo "<TD class=\"listCell\">&nbsp;OFF</TD>";
echo "<TD class=\"listCell\">&nbsp;".ini_get('output_buffering')."</TD>";
echo "</TR>";
echo "<TR class=\"listCell\">";
echo "<TD class=\"listCell\">Session auto start:</TD>";
echo "<TD class=\"listCell\">&nbsp;OFF</TD>";
echo "<TD class=\"listCell\">&nbsp;".ini_get('session.auto_start')."</TD>";
echo "</TR>";



?> 