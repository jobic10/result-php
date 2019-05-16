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

$stud_regno=$_GET['regno'];

if (isset($stud_regno)){

mysqli_select_db( $conn, $database_conn);
$query_students = "SELECT * FROM students WHERE reg_no='$stud_regno'";
$students = mysqli_query( $conn, $query_students) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$row_students = mysqli_fetch_assoc($students);
$totalRows_students = mysqli_num_rows($students);

mysqli_select_db( $conn, $database_conn);
$query_result = "SELECT * FROM second_semester WHERE reg_no='$stud_regno'";
$result = mysqli_query( $conn, $query_result) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$row_result = mysqli_fetch_assoc($result);
$totalRows_result = mysqli_num_rows($result);

$cus=0;
$gps=0;
$sgpa=0;
}

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
.style5 {color: #FFFFFF; font-weight: bold; }
.style6 {font-size: 14px}
.style15 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
.style17 {color: #000000; font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
.style19 {font-size: 15px}
-->
</style>
</head>
<body bgcolor="#ffffff">
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#3366CC">
    <td colspan="3" rowspan="2" bgcolor="#000000"><img src="images/logo.png" width="146" height="139" /></td>
    <td height="63" colspan="3" align="center" valign="bottom" nowrap="nowrap" bgcolor="#000000" id="logo"><div align="left"><strong>STUDENT RESULT BOARD</strong></div></td>
    <td width="54" bgcolor="#000000">&nbsp;</td>
  </tr>

  <tr bgcolor="#3366CC">
    <td height="64" colspan="3" align="center" valign="top" bgcolor="#000000" id="tagline"><div align="left"><strong>COMPUTER SCIENCE DEPT, The Federal Polytechnic Nasarawa </strong></div></td>
	<td width="54" bgcolor="#000000">&nbsp;</td>
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
          <td width="165"><a href="lecturer_main.php" class="navText">Home</a></td>
        </tr>
        <tr>
          <td width="165"><a href="assessment.php" class="navText">Assessment</a></td>
        </tr>
        <tr>
          <td width="165"><a href="results.php" class="navText">Result </a></td>
        </tr>
        <tr>
          <td width="165"><a href="<?php echo $logoutAction ?>" class="navText">Log Out </a></td>
        </tr>
      </table>
 	 <br />
  	&nbsp;<br />
  	&nbsp;<br />
  	&nbsp;<br /> 	</td>
    <td colspan="6"><img src="mm_spacer.gif" alt="" width="50" height="1" border="0" /><img src="mm_spacer.gif" alt="" width="305" height="1" border="0" /><br />
      &nbsp;<br />
      &nbsp;<br />
      <table border="0" cellspacing="0" cellpadding="0" width="800">
        <tr>
          <td width="376" class="pageName"><div align="center" class="bodyText style6">
            <p class="navText style19">The Federal Polytechnic Nasarawa <br />
              Examination Result<br />
              School of Applied Science,,<br />
              Department of Computer Science <br />
              <br />
              <span class="style3">2ND SEMESTER </span></p>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="38%" class="navText"><span class="style15">STUDENT NAME </span></td>
                <td width="62%" class="navText"><span class="style17"><?php echo $row_students['student_name']; ?></span></td>
                </tr>
              <tr>
                <td class="navText"><span class="style15">MATRIC NUMBER</span></td>
                <td class="navText"><span class="style17"><?php echo $row_students['reg_no']; ?></span></td>
                </tr>
              </table>
            </div></td>
        </tr>
        
        <tr>
          <td class="bodyText"><table width="100%" border="3" cellpadding="3" cellspacing="3">
            <tr>
              <td bgcolor="#000000"><span class="style5">CODE</span></td>
              <td bgcolor="#000000"><span class="style5">COURSE</span></td>
              <td bgcolor="#000000"><span class="style5">C/UNIT</span></td>
              <td bgcolor="#000000"><span class="style5">GRADE POINT </span></td>
              </tr>
            <?php do { ?>
              <tr>
                <td><?php echo $row_result['code']; ?></td>
                <td><?php echo $row_result['course']; ?></td>
                <td><?php echo $row_result['cu']; ?></td>
                <td><?php echo $row_result['gp']; ?></td>
                <?php $gps=$gps+$row_result['gp']; ?>
                <?php $cus=$cus+$row_result['cu']; ?>
                <?php $sgpa=$gps/$cus; ?>
                </tr>
              <?php } while ($row_result = mysqli_fetch_assoc($result)); ?>
          </table></td>
        </tr>
      </table>
       
      <table width="83%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="66%" bgcolor="#CCCCCC"><span class="style5"><span class="style3">GRADE POINT AVERAGE:</span> </span></td>
          <td width="34%" bgcolor="#CCCCCC"><div align="left"><?php echo number_format($sgpa,2); ?></div></td>
        </tr>
        <?php do { ?>
          <?php } while ($row_result = mysqli_fetch_assoc($result)); ?>
      </table>
      <p>&nbsp;</p>
      <p><br />	  
    </p>      <img src="mm_spacer.gif" alt="" width="50" height="1" border="0" /><br />
    &nbsp;</td>
  </tr>
  <tr>
    <td width="165" bgcolor="#000000">&nbsp;</td>
    <td width="50" bgcolor="#000000">&nbsp;</td>
    <td width="5" bgcolor="#000000">&nbsp;</td>
    <td width="374" bgcolor="#000000"><p align="center"><span class="style3">Webmasters:</span><br />
      <span class="style2"><?php echo $who; ?>    </span></p>
    </td>
    <td width="50" bgcolor="#000000">&nbsp;</td>
    <td width="160" bgcolor="#000000">&nbsp;</td>
	<td width="54" bgcolor="#000000">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
((mysqli_free_result($students) || (is_object($students) && (get_class($students) == "mysqli_result"))) ? true : false);
?>
