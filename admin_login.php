<?php require_once('Connections/conn.php'); ?>
<?php
mysqli_select_db( $conn, $database_conn);
$query_admin_login = "SELECT username, password FROM users";
$admin_login = mysqli_query( $conn, $query_admin_login) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$row_admin_login = mysqli_fetch_assoc($admin_login);
$totalRows_admin_login = mysqli_num_rows($admin_login);
?><?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "admin_main.php";
  $MM_redirectLoginFailed = "admin_login.php";
  $MM_redirecttoReferrer = false;
  mysqli_select_db( $conn, $database_conn);
  
  $LoginRS__query=sprintf("SELECT username, password FROM users WHERE username='%s' AND password='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysqli_query( $conn, $LoginRS__query) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<title>The Federal Polytechnic Nasarawa ~ Computer Science Online Result Board</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="mm_travel2.css" type="text/css" />
<script language="JavaScript" type="text/javascript">
//--------------- LOCALIZEABLE GLOBALS ---------------
var d=new Date();
var monthname=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
//Ensure correct for language. English is "January 1, 2004"
var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
//---------------   END LOCALIZEABLE   ---------------
</script>
<style type="text/css">
<!--
.style2 {color: #FFFFFF}
.style3 {color: #000000}
-->
</style>
</head>
<body bgcolor="#ffffff">
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td bgcolor="#003366"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
  </tr>

  <tr bgcolor="#CCFF99">
  	<td height="25" bgcolor="#E6F3FF" id="dateformat">&nbsp;</td>
  </tr>
 <tr>
    <td bgcolor="#003366"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
  </tr>

 <tr>
    <td valign="top" bgcolor="#FFFFFF"><form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
        <table width="305" border="0" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0">
          <tr>
            <td bgcolor="#F4FFE4" class="pageName">Administrative Login </td>
          </tr>
          <tr>
            <td bgcolor="#F4FFE4" class="bodyText"><table width="275" border="0" cellpadding="0" cellspacing="0" bgcolor="#F4FFE4">
              <tr>
                <td><label>Username:</label></td>
                <td><label>
                  <input name="username" type="text" id="username" />
                  </label></td>
                </tr>
              <tr>
                <td><label>Password:</label>
                  &nbsp;</td>
                <td><label>
                  <input name="password" type="password" id="password" />
                  </label></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="Submit" value="Login" /></td>
                </tr>
              </table>
              <p>&nbsp;</p></td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
</body>
</html>
<?php
((mysqli_free_result($admin_login) || (is_object($admin_login) && (get_class($admin_login) == "mysqli_result"))) ? true : false);
?>
