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

 if (isset ($_GET['mode'])) { $mode = strip_tags($_GET['mode']); }
?>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
            <td width="125px" align="right"><?php if ($mode == '') { echo "<b>Install Type</b>"; } else { echo "Install Type"; } ?>
		</td>
            <td><img src="i/lb.gif"></td>
       </tr>
       <tr>
            <td colspan="2"><img src="i/ldiv.gif"></td>
       </tr>
       <tr>
            <td width="125px" align="right"><?php if ($mode == 'step2') { echo "<b>License Agreement</b>"; } else { echo "License Agreement"; } ?>
		</td>
            <td><img src="i/lb.gif"></td>
       </tr>
	<tr>
            <td colspan="2"><img src="i/ldiv.gif"></td>
       </tr>
       <tr>
            <td width="125px" align="right"><?php if ($mode == 'step3') { echo "<b>Compatability Check</b>"; } else { echo "Compatability Check"; } ?>
		</td>
            <td><img src="i/lb.gif"></td>
       </tr>
	<tr>
            <td colspan="2"><img src="i/ldiv.gif"></td>
       </tr>
       <tr>
            <td width="125px" align="right"><?php if ($mode == 'step4') { echo "<b>Database Setup</b>"; } else { echo "Database Setup"; } ?>
		</td>
            <td><img src="i/lb.gif"></td>
       </tr>
       <tr>
            <td colspan="2"><img src="i/ldiv.gif"></td>
       </tr>
       <tr>
            <td width="125px" align="right"><?php if ($mode == 'step5') { echo "<b>Verify Install</b>"; } else { echo "Verify Install"; } ?>
		</td>
            <td><img src="i/lb.gif"></td>
       </tr>
       <tr>
            <td colspan="2"><img src="i/ldiv.gif"></td>
       </tr>
       <tr>
            <td width="125px" align="right"><?php if ($mode == 'step6') { echo "<b>Install Completed</b>"; } else { echo "Install Completed"; } ?>
		</td>
            <td><img src="i/lb.gif"></td>
       </tr>
       <tr>
            <td colspan="2"><img src="i/ldiv.gif"></td>
       </tr>
</table>