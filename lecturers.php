<?php require_once('Connections/conn.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "lg.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "h82jox3jifn903yfushx02he0fg04n043hf9r93he0wndw292b2193yfh3493he90ef903hr390.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM lecturers WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysqli_select_db( $conn, $database_conn);
  $Result1 = mysqli_query( $conn, $deleteSQL) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO lecturers (lecturer, username, password) VALUES ( %s, %s, %s)",
                       
                       GetSQLValueString($_POST['lecturer'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"));

  mysqli_select_db( $conn, $database_conn);
  $Result1 = mysqli_query( $conn, $insertSQL) or die(mysqli_error($GLOBALS["___mysqli_ston"]));

  $insertGoTo = "lecturers.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysqli_select_db( $conn, $database_conn);
$query_lecturers = "SELECT * FROM lecturers";
$lecturers = mysqli_query( $conn, $query_lecturers) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$row_lecturers = mysqli_fetch_assoc($lecturers);
$totalRows_lecturers = mysqli_num_rows($lecturers);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
  <tr bgcolor="#3366CC">
    <td colspan="3" rowspan="2" bgcolor="#000000"><img src="images/logo.png" width="146" height="139" /></td>
    <td height="63" colspan="3" align="center" valign="bottom" nowrap="nowrap" bgcolor="#000000" id="logo"><div align="left"><strong>STUDENT RESULT BOARD</strong></div></td>
    <td width="111" bgcolor="#000000">&nbsp;</td>
  </tr>

  <tr bgcolor="#3366CC">
    <td height="64" colspan="3" align="center" valign="top" bgcolor="#000000" id="tagline"><div align="left"><strong>COMPUTER SCIENCE DEPT, The Federal Polytechnic Nasarawa </strong></div></td>
	<td width="111" bgcolor="#000000">&nbsp;</td>
  </tr>

  <tr>
    <td colspan="7" bgcolor="#003366"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
  </tr>

  <tr bgcolor="#CCFF99">
  	<td height="25" colspan="7" bgcolor="#E6F3FF" id="dateformat">&nbsp;&nbsp;<script language="JavaScript" type="text/javascript">
      document.write(TODAY);	</script>	</td>
  </tr>
 <tr>
    <td colspan="7" bgcolor="#003366"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
  </tr>

 <tr>
    <td width="165" valign="top" bgcolor="#FFFFFF">
	<table border="0" cellspacing="0" cellpadding="0" width="165" id="navigation">
        <tr>
          <td width="165">&nbsp;<br />
		 &nbsp;<br /></td>
        </tr>
        <tr>
          <td width="165"><a href="admin_main.php" class="navText">Home</a></td>
        </tr>
        <tr>
          <td width="165"><a href="courses.php" class="navText">Courses </a></td>
        </tr>
        <tr>
          <td width="165"><a href="sessions.php" class="navText">Sessions </a></td>
        </tr>		
        <tr>
          <td><a href="lecturers.php" class="navText">Lecturers</a></td>
        </tr>
        <tr>
          <td><a href="students.php" class="navText">Students</a></td>
        </tr>
        <tr>
          <td><a href="results.php" class="navText">Results</a></td>
        </tr>
        <tr>
          <td width="165"><a href="<?php echo $logoutAction ?>" class="navText">Log Out </a></td>
        </tr>
      </table>
 	 <br />
  	&nbsp;<br />
  	&nbsp;<br />
  	&nbsp;<br /> 	</td>
    <td width="50"><img src="mm_spacer.gif" alt="" width="50" height="1" border="0" /></td>
    <td colspan="2" valign="top"><img src="mm_spacer.gif" alt="" width="305" height="1" border="0" /><br />
	&nbsp;<br />
	&nbsp;<br />
	<table border="0" cellspacing="0" cellpadding="0" width="329">
        <tr>
          <td width="329" class="pageName">Lecturer's Management </td>
		</tr>

		<tr>
          <td class="bodyText"><form method="post" name="form1" action="<?php echo $editFormAction; ?>">
              <table width="100%" align="center">

                <tr valign="baseline">
                  <td nowrap align="right"><div align="left"><strong>Lecturer:</strong></div></td>
                  <td><input type="text" name="lecturer" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left"><strong>Username:</strong></div></td>
                  <td><input type="text" name="username" value="" size="20"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left"><strong>Password:</strong></div></td>
                  <td><input type="password" name="password" value="" size="20"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right">&nbsp;</td>
                  <td><input type="submit" value="Create"></td>
                </tr>
              </table>
              <input type="hidden" name="MM_insert" value="form1">
            </form>
          </td>
        </tr>
		<tr>
		  <td class="bodyText">&nbsp;
            <table width="100%" border="8" align="center" cellpadding="8" cellspacing="8">
              <tr>
                <td bgcolor="#000000"><span class="style2">LECTURER</span></td>
                <td bgcolor="#000000"><span class="style2">USERNAME</span></td>
                <td bgcolor="#000000"><span class="style2">PASSWORD</span></td>
                <td bgcolor="#000000">&nbsp;</td>
              </tr>
              <?php do { ?>
                <tr>
                  <td><?php echo $row_lecturers['lecturer']; ?></td>
                  <td><?php echo $row_lecturers['username']; ?></td>
                  <td><?php echo $row_lecturers['password']; ?></td>
                  <td><a href="lecturers.php?id=<?php echo $row_lecturers['id']; ?>">DELETE</a></td>
                </tr>
                <?php } while ($row_lecturers = mysqli_fetch_assoc($lecturers)); ?>
            </table></td>
	    </tr>
      </table>
     <br />	  </td>
    <td width="50"><img src="mm_spacer.gif" alt="" width="50" height="1" border="0" /></td>
        <td width="177" valign="top"><div align="center"><br />
	&nbsp;Please take note that lecturers have access to modify student result, So we advice the admin reading this information (Mall. A.A zubair) to please create trusted and trained personnel to handle this E.g Mr. Sheidu</div></td>
        <td width="111" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td width="165" bgcolor="#000000">&nbsp;</td>
    <td width="50" bgcolor="#000000">&nbsp;</td>
    <td width="4" bgcolor="#000000">&nbsp;</td>
    <td width="301" bgcolor="#000000"><p align="center"><span class="style3">Webmasters:</span><br />
      <span class="style2"><?php echo $who; ?>  </span></p>
    </td>
    <td width="50" bgcolor="#000000">&nbsp;</td>
    <td width="177" bgcolor="#000000">&nbsp;</td>
	<td width="111" bgcolor="#000000">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
((mysqli_free_result($lecturers) || (is_object($lecturers) && (get_class($lecturers) == "mysqli_result"))) ? true : false);
?>
