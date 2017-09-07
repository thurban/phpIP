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

case "update":
{
 $gid = 1;
 if (isset ($_POST['username'])) { $user = strip_tags($_POST['username']); }
 if (isset ($_POST['type'])) { $type = strip_tags($_POST['type']); }
 if (isset ($_POST['access_level'])) { $accesslevel = strip_tags($_POST['access_level']); }
 if (isset ($_POST['name'])) { $name = strip_tags($_POST['name']); }
 if (isset ($_POST['email'])) { $email = strip_tags($_POST['email']); }
 if (isset ($_GET['uid'])) { $uid = strip_tags($_GET['uid']); }
 if (isset ($_POST['gid'])) { $gid = strip_tags($_POST['gid']); }


// Use the myheader function from layout.php
myheader("User Management -- Account Updated");


$update_user = mysql_query("UPDATE `users` SET `username` = '$user', `type` = '$type', 
		`access_level` = '$accesslevel', `name` = '$name', `email` = '$email', `groupid` = $gid WHERE `uid` = '$uid'");

// Redirect to user_management.php after sql insert
?>

<h2>
<font color="FF0000">Updating Database, Please wait</font>
</h4>
<meta http-equiv=Refresh content=1;url="user_management.php">
<?php
} //end
break;

case "add":
{
 $gid = 1;
 if (isset ($_POST['username'])) { $user = strip_tags($_POST['username']); }
 if (isset ($_POST['type'])) { $type = strip_tags($_POST['type']); }
 if (isset ($_POST['access_level'])) { $accesslevel = strip_tags($_POST['access_level']); }
 if (isset ($_POST['name'])) { $name = strip_tags($_POST['name']); }
 if (isset ($_POST['email'])) { $email = strip_tags($_POST['email']); }
 if (isset ($_POST['password'])) { $password = strip_tags($_POST['password']); }
 if (isset ($_POST['password2'])) { $password2 = strip_tags($_POST['password2']); }
 if (isset ($_POST['gid'])) { $gid = strip_tags($_POST['gid']); }

// Use the myheader function from layout.php
myheader("User Management -- Adding Account");

// If both passwords were posted, validate they match.
   if($_POST['password'] != $_POST['password2']){
		echo "<h1>Input Errors:</h1>";
	      echo "<h3> Please use your browser back button and complete the installation form.</h3>";
            echo "Passwords do not match!\n\n";
      footer();
      exit();
   }

$user_add = mysql_query("
	INSERT INTO `users` (`username` , `access_level` , `type` , `name` , `email` , `password`, `groupid`)
	 VALUES ('$user', '$accesslevel', '$type', '$name', '$email', MD5( '$password' ), $gid);
");

// Redirect to user_management.php after sql insert
?>
<h2>
<font color="FF0000">Updating Database, Please wait</font>
</h4>
<meta http-equiv=Refresh content=1;url="user_management.php">
<?php
} //end
break;

case "edit":
{
 if (isset ($_GET['uid'])) { $uid = strip_tags($_GET['uid']); }

// Use the myheader function from layout.php
myheader("User Management -- Account Edit");

	$sql_edit = mysql_query("SELECT * FROM `users` WHERE `uid` = '$uid'");
	    while ($row = mysql_fetch_array($sql_edit)) {
		$username = $row[username];
		$type = $row[type];
		$accesslevel = $row[access_level];
		$name = $row[name];
		$email = $row[email];
		$cur_gid = $row[groupid];
    }

?>
<FORM action="<?php $PHPSELF;?>?mode=update&uid=<?php echo $uid;?>" method=post name="editupdate">
  <table class="listTable" style="width:100%" cellpadding="0" cellspacing="0">
    <TR class="listCell">
      <TD class="listCell" colspan="2">Local and LDAP User Management</TD>
    </TR>
    <tr class="listHeadRow">
      <TD class="listCell" colspan="2">ADD</TD>
    </TR>
    <tr class="listRow2">
      <TD class="listCell"><font color="#FF0000">*</font> Username</TD>
           <TD class="listCell"><INPUT name="username" value="<?php echo stripslashes($username);?>"></TD>
    </tr>
    <tr class="listRow1">
      <TD class="listCell"><font color="#FF0000">*</font> Login Type</TD>
      <TD class="listCell"><select name="type">
          <option selected><?php echo $type;?>
          <option value="">-----</option>
          <option>local</option>
          <option>ldap</option>
        </select>
      </TD>
    </tr>
    <tr class="listRow2">
      <TD class="listCell"><font color="#FF0000">*</font> Access Level</TD>
      <TD class="listCell"><select name="access_level">
          <option selected><?php echo $accesslevel;?>
          <option value="">-----</option>
          <option>Administrator</option>
          <option>Operator</option>
          <option>Guest</option>
        </select>
      </TD>
    <tr class="listRow1">
      <TD class="listCell">Group</TD>
      <TD class="listCell"><select name="gid">
          <?php
			$val = @mysql_query("SELECT * FROM groups");
			if (mysql_num_rows($val) > 0) {
				while($row = mysql_fetch_array($val)) {
					$gid = $row[id];
					$group = $row[group];
					if ($cur_gid == $gid) {
						echo "<option value=$gid selected>$group</option>";
						} else {
						echo "<option value=$gid>$group</option>";
					}
				}
			}
?>
        </select>
      </TD>
    </tr>
        <tr class="listRow2">
           <TD class="listCell">Name</TD>
           <TD class="listCell"><INPUT name="name" value="<?php echo stripslashes($name);?>"></TD>
       </tr>
        <tr class="listRow1">
           <TD class="listCell">Email</TD>
           <TD class="listCell"><INPUT name="email" value="<?php echo stripslashes($email);?>"></TD>
       </tr>
  </table>
  <table>
    <tr>
      <TD align=right><a href="javascript:document.editupdate.submit()">[UPDATE]</a></TD>
      <TD align=right><a href="javascript:history.back()">[GO BACK]</a></TD>
    </TR>
    </center>
    
  </table>
</FORM>
<?php

} //end
break;

case "delete":
{

// Use the myheader function from layout.php
myheader("User Management -- User Account Deleted");

if (isset ($_GET['uid'])) { $uid = strip_tags($_GET['uid']); }
  
  $delete = mysql_query("DELETE FROM `users` WHERE `uid` = '$uid'");
  $opt = mysql_query("OPTIMIZE TABLE `users`");

// Redirect to user_management.php after sql insert
?>
<h2>
<font color="FF0000">Updating Database, Please wait</font>
</h4>
<meta http-equiv=Refresh content=1;url="user_management.php">
<?php
} //end
break;

default:

// Use the myheader function from layout.php
myheader("Local and LDAP User Management");
  echo "<table class=\"listTable\" style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\">";
  echo "<tr class=\"listCell\">&nbsp;";
  echo "<td colspan=7 class=\"listCell\">Local and LDAP User Management</td>";
  echo "<tr class=\"listHeadRow\">";
  echo "<td align=center>&nbsp;&nbsp;</td>";
  echo "<td class=\"listCell\">USERNAME</td>";
  echo "<td class=\"listCell\">LOGIN TYPE</td>";
  echo "<td class=\"listCell\">ACCESS LEVEL</td>";
  echo "<td class=\"listCell\">NAME</td>";
  echo "<td class=\"listCell\">EMAIL</td>";
  echo "<td class=\"listCell\">GROUP</td>";
  echo "</tr>";

$users = mysql_query("SELECT * FROM users a INNER JOIN groups b ON a.groupid = b.id WHERE a.username <> '$_SESSION[username]' ORDER BY a.type");
    while ($lrow = mysql_fetch_array($users))
        {
        if ($RowClass == "listRow2") { $RowClass = "listRow1";
         }
          else
           { $RowClass = "listRow2";
        }
  echo "<tr class=\"$RowClass\">";
  echo "<td class=\"listCell\">&nbsp;<a href=\"user_management.php?mode=edit&uid=$lrow[uid]\">[Edit]</a>&nbsp;<a href=\"user_management.php?mode=delete&uid=$lrow[uid]\">[Delete]</a></td>";
  echo "<td class=\"listCell\">&nbsp;$lrow[username]</td>";
  echo "<td class=\"listCell\">&nbsp;$lrow[type]</td>";
  echo "<td class=\"listCell\">&nbsp;$lrow[access_level]</td>";
  echo "<td class=\"listCell\">&nbsp;$lrow[name]</td>";
  echo "<td class=\"listCell\">&nbsp;$lrow[email]</td>";
  echo "<td class=\"listCell\">&nbsp;$lrow[group]</td>";
  echo "</tr>";

    } //end loop

echo "</table><br />";
?>
<FORM action="<?php $PHPSELF;?>?mode=add" method=post name="useradd">
  <table class="listTable" style="width:100%" cellpadding="0" cellspacing="0">
    <TR class="listCell">
      <TD class="listCell" colspan="2">User Management</TD>
    </TR>
    <tr class="listHeadRow">
      <TD class="listCell" colspan="2">ADD</TD>
    </TR>
    <tr class="listRow2">
      <TD class="listCell"><font color="#FF0000">*</font> Username</TD>
      <TD class="listCell"><INPUT name="username" value=""></TD>
    </tr>
    <tr class="listRow1">
      <TD class="listCell"><font color="#FF0000">*</font> Login Type</TD>
      <TD class="listCell"><select name="type">
          <option>local</option>
          <option>ldap</option>
        </select>
      </TD>
    </tr>
    <tr class="listRow2">
      <TD class="listCell"><font color="#FF0000">*</font> Access Level</TD>
      <TD class="listCell"><select name="access_level">
          <option>Administrator</option>
          <option>Operator</option>
          <option>Guest</option>
        </select>
      </TD>
    <tr class="listRow1">
      <TD class="listCell">Group</TD>
      <TD class="listCell"><select name="gid">
          <?php
			$val = @mysql_query("SELECT * FROM groups");
			if (mysql_num_rows($val) > 0) 
			{
				while($row = mysql_fetch_array($val)) 
				{
					$gid = $row[id];
					$group = $row[group];
					if ($_SESSION['groupid'] == $gid) {
						echo "<option value=$gid selected>$group</option>";
						} else {
						echo "<option value=$gid>$group</option>";
					}
				}
			}
?>
        </select>
      </TD>
    </tr>
    <tr class="listRow2">
      <TD class="listCell">Name</TD>
      <TD class="listCell"><INPUT name="name" value=""></TD>
    </tr>
    <tr class="listRow1">
      <TD class="listCell">Email</TD>
      <TD class="listCell"><INPUT name="email" value=""></TD>
    </tr>
    <tr class="listRow2">
      <TD class="listCell">Password</TD>
      <TD class="listCell"><INPUT type="password" name="password" value=""></TD>
    </tr>
    <tr class="listRow1">
      <TD class="listCell">Confirm Password</TD>
      <TD class="listCell"><INPUT type="password" name="password2" value=""></TD>
    </tr>
    </table>
  <table>
    <tr>
      <TD align=right><a href="javascript:document.useradd.submit()">[ADD]</a></TD>
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
