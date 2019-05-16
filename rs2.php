<?php require_once('Connections/conn.php');
error_reporting(0); ?>
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
<title>SECOND SEMESTER RESULT FOR <?php echo $row_students['student_name']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="mm_travel2.css" type="text/css" />
<script language="JavaScript" type="text/javascript">
//--------------- LOCALIZEABLE GLOBALS ---------------
var d=new Date();
var monthname=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
//Ensure correct for language. English is "January 1, 2004"
var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
//---------------   END LOCALIZEABLE   ---------------
</script><SCRIPT LANGUAGE="JavaScript">
function printPage() {
if (window.print) {
agree = confirm('Dear, <?php echo $row_students['student_name']; ?> This page contains sensitive information that \nwe recommend you to print a copy of your result . \n\nOK to print now?');
if (agree) window.print(); 
else
alert ("Please Continue");
   }
}
//  End -->
</script>
<style type="text/css">
<!--
.style2 {color: #FFFFFF}
.style3 {color: #000000}
.style5 {color: #FFFFFF; font-weight: bold; }
.style6 {font-size: 14px}
.style15 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
.style17 {color: #000000; font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
.style19 {
	font-size: 15px;
	text-align: center;
}
body p {
	text-align: left;
}
-->
</style>
</head>
<body bgcolor="#ffffff" OnLoad="printPage()">
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td width="858" bgcolor="#003366"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
  </tr>
 <tr>
    <td bgcolor="#003366"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
  </tr>

 <tr>
    <td valign="top" bgcolor="#FFFFFF"><div align="center"><img src="mm_spacer.gif" alt="" width="50" height="1" border="0" /><img src="mm_spacer.gif" alt="" width="305" height="1" border="0" /><br />
      <table border="5" cellspacing="8" cellpadding="5" width="900">
        <tr>
          <td width="376" class="pageName"><div align="center" class="bodyText style6">
            <p class="navText style19">The Federal Polytechnic Nasarawa <br />
              Examination Result<br />
              School of Applied Science<br />
              Department of Computer Science <br />
              <img src="images/house.png" alt="" width="100" height="100" /></p>
            <p class="navText style19">
              <marquee behavior="alternate">
                SECOND SEMESTER EXAMINATION RESULT</marquee>
            </p>
            <table width="100%" border="2" cellspacing="2" cellpadding="2">
              <tr>
                <td width="38%" class="navText"><span class="style15">STUDENT NAME </span></td>
                <td width="62%" class="navText"><span class="style17"><?php echo $row_students['student_name']; ?></span></td>
                </tr>
              <tr>
                <td class="navText"><span class="style15">MATRIC NUMBER</span></td>
                <td class="navText"><span class="style17"><?php echo $row_students['reg_no']; ?></span></td>
                </tr>
              <tr>
                <td class="navText">SCHOOL</td>
                <td class="navText">APPLIED SCIENCE</td>
                </tr>
              <tr>
                <td class="navText">DEPARTMENT</td>
                <td class="navText">COMPUTER SCIENCE</td>
                </tr>
              <tr>
                <td class="navText">HEAD OF DEPARTMENT</td>
                <td class="navText">MR. P.S IDOKO</td>
                </tr>
              </table>
            </div></td>
          </tr>
        
        <tr>
          <td class="bodyText"><table width="100%" border="5" align="center" cellpadding="5" cellspacing="5">
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
       
    </div>
      <table width="83%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="66%" bgcolor="#CCCCCC"><span class="style5"><span class="style3">GRADE POINT AVERAGE:</span> </span></td>
          <td width="34%" bgcolor="#CCCCCC"><div align="left"><?php echo number_format($sgpa,2); ?></div></td>
        </tr>
        <?php do { ?>
          <?php } while ($row_result = mysqli_fetch_assoc($result)); ?>
      </table>
      <p align="right"><script language="JavaScript" type="text/javascript">
if (window.print) {
document.write('<form> '
+ '<input type=button name=print value="Click" '
+ 'onClick="javascript:window.print()"> To Print Your Result</form>');
}
// End -->
        </script>
      </p>
      <p align="left">Any Score below 40 is equated to Carry Over.</p>
      <table width="165" border="2" align="left" cellpadding="2" cellspacing="2" id="navigation">
        <tr>
          <td width="165"><a href="<?php echo $logoutAction ?>" class="navText">Log out</a></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php
((mysqli_free_result($students) || (is_object($students) && (get_class($students) == "mysqli_result"))) ? true : false);
?>
