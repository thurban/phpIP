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

switch ($_REQUEST["req"]) {
case "validate":
{
if(!$_POST['username'] || !$_POST['password'] ) {
        myheader("Error! Missing Information");
          echo "<center><h3><font color='red'>WARNING... </font> Missing Login Information.<br />
                Please use your browser back button and complete the login form.</h3></center>";
        footer();
exit();

}
// Start login check
else {
 if (isset ($_POST['username'])) { $username = strip_tags($_POST['username']); }
 if (isset ($_POST['password'])) { $password = strip_tags($_POST['password']); }

// stripslashes on data
 $username = stripslashes($username);
 $password = stripslashes($password);

             $check = @mysql_query("SELECT * FROM `users` WHERE `username` = '$username'");
            if (mysql_num_rows($check) == 1) {
                   while($row = mysql_fetch_array($check)) {
                        $LoginType = $row[type];
                                switch ($LoginType) {
                                  case "local":
                                   $val = @mysql_query("SELECT * FROM `users` WHERE `type` = 'local' AND 
                                                                `username` = '$username' AND 
                                                                `password` = md5('$password')");
                                    if (mysql_num_rows($val) == 0) {
                                        myheader("Login! ACCESS DENIED");
                                        // If user is known, but wrong password
                                        echo "<center><h3><font color='red'>WARNING... </font> You do not appear to be logged on.<br />
                                                This could be due to your Session timing out or Invalid Username/Password.</br></br>
                                                Please use your browser back button and complete the login form.</h3></center>";
                                        footer();
                                        exit();
                                    } else { break; }
                                  case "ldap":
                                    $sql = mysql_query("SELECT * FROM `ldap` ORDER BY `ldapId`");
                                        if (mysql_num_rows($sql) == 0) {
                                           myheader("Login! ACCESS DENIED");
                                           // Check for ldap
                                           echo "<center><h3><font color='red'>WARNING... </font> You do not appear to be logged on.<br />
                                                This could be due to your Session timing out or Invalid Username/Password.</br></br>
                                                Please use your browser back button and complete the login form.</h3></center>";
                                           footer();
                                           exit();
                                        } else {
                                          while($row = mysql_fetch_array($sql)) {
                                                $LDAPCONNECT = $row[ldapConnect];
                                                $LDAPPORT = $row[ldapPort];
                                        }
                                        $LdapConnect = explode(".", $LDAPCONNECT);
                                                  $uid = "$username@$LDAPCONNECT";
                                         $ds = @ldap_connect("$LDAPCONNECT", $LDAPPORT);  // must be a valid LDAP server!
                                           $attr = "password";
                                                   if ($ds) {
                                                     $r=@ldap_bind($ds, $uid, $password); /// read-only access
                                                      if ($r == "true") {
                                                            $sr=ldap_search($ds,"dc=$LdapConnect[0], dc=$LdapConnect[1], dc=$LdapConnect[2]", "SamAccountName=$username");
                                                            $info = ldap_get_entries($ds, $sr);
                                                                    for ($i=0; $i<$info["count"]; $i++) {
                                                                        $_SESSION['name'] = $info[$i]["cn"][0];
                                                                        $_SESSION['email'] = $info[$i]["mail"][0];
                                                                       }
                                                      ldap_close($ds);
                                                   $val = @mysql_query("SELECT * FROM `users` WHERE `username` = '$username' AND 
                                                                `type` = 'ldap'"); 
                                                      } else { myheader("Login! ACCESS DENIED");
                                                                // Default prompt if user is unknown
                                                                echo "<center><h3><font color='red'>WARNING... </font> You do not appear to be logged on.<br />
                                                                This could be due to your Session timing out or Invalid Username/Password.</br></br>
                                                                Please use your browser back button and complete the login form.</h3></center>";
                                                                   footer();
                                                                   exit();
                                                                } 
                                                   } 
                                        }
                                } 
            }
            if (mysql_num_rows($val) == 1) {
                while($row = mysql_fetch_array($val)) {
                $uid = $row[uid];
                $_SESSION['name']         = $row[name];
                $_SESSION['email']        = $row[email];
                $_SESSION['access_level'] = $row[access_level];
                $_SESSION['email']        = $row[email];
                $_SESSION['groupid']      = $row[groupid];
                }
                // if login ok, then session is true
                $_SESSION['login']        = true;
                $_SESSION['username']     = $username;

		// test sort order

        // add version 
           $version_defined = @mysql_query("SELECT * FROM `version` ");
                while($row = mysql_fetch_array($version_defined)) {
                $_SESSION['version'] = $row[phpip];
                }
        // add preference
           $pref_defined = mysql_query("SELECT * FROM `preference` WHERE `uid` = '$uid'");
        if (mysql_num_rows($pref_defined) == 1) {
            while($row = mysql_fetch_array($pref_defined)) {
              $_SESSION['style'] = $row[style];
              $_SESSION['showCidr'] = $row[showCidr];
              $_SESSION['showPrefix'] = $row[showPrefix];
              $_SESSION['showDeviceData'] = $row[showDeviceData];
              $_SESSION['sorder1']      = $row[sorder1];
              $_SESSION['sorder2']      = $row[sorder2];
              $_SESSION['sorder3']      = $row[sorder3];
              $_SESSION['sorder4']      = $row[sorder4];
              $_SESSION['resolveDNS']   = $row[resolveDNS];
            }
        } 
        else {
              $_SESSION['sorder1']      = "ip";
              $_SESSION['sorder2']      = "mask";
              $_SESSION['sorder3']      = "description";
              $_SESSION['sorder4']      = "client";
              $_SESSION['style'] 	= "default.css";
              $_SESSION['showDeviceData'] = '0';
              $_SESSION['resolveDNS'] = '0';
              }
                         header("Location: display.php"); 
        } else { myheader("Login! ACCESS DENIED");
                // Default prompt if user is unknown
                echo "<center><h3><font color='red'>WARNING... </font> You do not appear to be logged on.<br />
                        This could be due to your Session timing out or Invalid Local Username/Password.</br></br>
                        Please use your browser back button and complete the login form.</h3></center>";
           footer();
                   exit();
                   }
            }
    }
} //end case
break;

default:

// Use the myheader function from layout.php
myheader("Login");

?>
<body onload="document.login.username.focus()">
<form name="login" method="post" action="login.php?req=validate">

<table align="center">
        <tr>
                <td colspan="2"></td>
        </tr>
                <tr height="10"><td></td></tr>
        <tr>
                <td colspan="2"><h2>Please enter your username and password below:</h2></td>
        </tr>
        <tr height="10"><td></td></tr>
        <tr>

                <td>User Name:</td>
                <td><input type="text" name="username" size="40" style="width: 295px;"></td>
        </tr>
        <tr>
                <td>Password:</td>
                <td><input type="password" name="password" size="40" style="width: 295px;"></td>
        </tr>
                <tr>
                <tr height="10"><td></td></tr>
        <tr>
                <td><input TYPE="Image" src="i/login.png" onClick="document.login.submit();"></td>
        </tr>
</table>

<input type="hidden" name="action" value="login">

</form>
<?php

  // Use the footer function from layout.php
  footer();

} // end switch

?>
