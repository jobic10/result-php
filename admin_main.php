<?php
include "Connections/conn.php";

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
  <tr bgcolor="#3366CC">
    <td colspan="3" rowspan="2" bgcolor="#000000"><img src="images/logo.png" width="146" height="139" /></td>
    <td height="63" colspan="3" align="center" valign="bottom" nowrap="nowrap" bgcolor="#000000" id="logo"><div align="left"><strong>STUDENT RESULT BOARD</strong></div></td>
    <td width="171" bgcolor="#000000">&nbsp;</td>
  </tr>

  <tr bgcolor="#3366CC">
    <td height="64" colspan="3" align="center" valign="top" bgcolor="#000000" id="tagline"><div align="left"><strong>COMPUTER SCIENCE DEPT, The Federal Polytechnic Nasarawa </strong></div></td>
	<td width="171" bgcolor="#000000">&nbsp;</td>
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
    <td width="172" valign="top" bgcolor="#FFFFFF">
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
          <td width="165"><a href="grading.php" class="navText">Grading </a></td>
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
      </table></td>
    <td colspan="5"><div align="center"><img src="mm_spacer.gif" alt="" width="50" height="1" border="0" /></div>      <div align="center">
        <table border="0" cellspacing="0" cellpadding="0" width="673">
          <tr>
            <td width="329" class="pageName"><div align="center">
              <p>Welcome to the administrator panel</p>
              <p>This account can only be controlled by the Head Of Department (Mr. P.S Idoko)</p>
            </div></td>
          </tr>
          
          <tr>
            <td class="bodyText"><p>&nbsp;</p>		</td>
          </tr>
        </table>
         <br />
        <img src="images/home-new-bg.jpg" width="650" height="236" />      <img src="mm_spacer.gif" alt="" width="50" height="1" border="0" /><br />
    &nbsp;</div></td>
    <td width="171" bgcolor="#FFFFFF"><div align="center">
      <p><img src="HOD.jpg" width="158" height="235" /></p>
      <p>Please try to make your login credentials safe from others.</p>
    </div>
      <p align="center">For the safety of this yet-to-be hosted wesbite, results are going to be uploaded locally on localhost server</p>
      <p align="center">Scores are not going to be displayed due to the fact that it could easily be modified. The grade points will be made available.</p>
    <p align="center">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="172" bgcolor="#000000">&nbsp;</td>
    <td width="64" bgcolor="#000000">&nbsp;</td>
    <td width="5" bgcolor="#000000">&nbsp;</td>
    <td width="387" bgcolor="#000000"><p align="center"><span class="style3">Webmasters:</span><br />
      <span class="style2"><?php echo $who; ?>
     -<br />
     -      </span></p>
    </td>
    <td width="64" bgcolor="#000000">&nbsp;</td>
    <td width="174" bgcolor="#000000">&nbsp;</td>
	<td width="171" bgcolor="#000000">&nbsp;</td>
  </tr>
</table>
</body>
</html>
