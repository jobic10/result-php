<?php require_once('Connections/conn.php'); 
error_reporting(0);
?>
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
$query_result = "SELECT * FROM first_semester WHERE reg_no='$stud_regno'";
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
<link rel="icon" type="image/ico" href="favicon.ico"/>
<style type="text/css">
<!--
/*Do not Alter these. Set for alignment*/
.css1{
position:absolute;top:0px;left:0px;
width:16px;height:16px;
font-family:Arial,sans-serif;
font-size:16px;
text-align:center;
font-weight:bold;
}
.css2{
position:absolute;top:0px;left:0px;
width:10px;height:10px;
font-family:Arial,sans-serif;
font-size:10px;
text-align:center;
}
//-->
</style>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function GetCookie (name) {
var arg = name + "=";
var alen = arg.length;
var clen = document.cookie.length;
var i = 0;
while (i < clen) {
var j = i + alen;
if (document.cookie.substring(i, j) == arg)
return getCookieVal (j);
i = document.cookie.indexOf(" ", i) + 1;
if (i == 0) break;
}
return null;
}
function SetCookie (name, value) {
var argv = SetCookie.arguments;
var argc = SetCookie.arguments.length;
var expires = (argc > 2) ? argv[2] : null;
var path = (argc > 3) ? argv[3] : null;
var domain = (argc > 4) ? argv[4] : null;
var secure = (argc > 5) ? argv[5] : false;
document.cookie = name + "=" + escape (value) +
((expires == null) ? "" : ("; expires=" + expires.toGMTString())) +
((path == null) ? "" : ("; path=" + path)) +
((domain == null) ? "" : ("; domain=" + domain)) +
((secure == true) ? "; secure" : "");
}
function DeleteCookie (name) {
var exp = new Date();
exp.setTime (exp.getTime() - 1);
var cval = GetCookie (name);
document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
}
var expDays = 30;
var exp = new Date();
exp.setTime(exp.getTime() + (expDays*24*60*60*1000));
function amt(){
var count = GetCookie('count')
if(count == null) {
SetCookie('count','1')
return 1
}
else {
var newcount = parseInt(count) + 1;
DeleteCookie('count')
SetCookie('count',newcount,exp)
return count
   }
}
function getCookieVal(offset) {
var endstr = document.cookie.indexOf (";", offset);
if (endstr == -1)
endstr = document.cookie.length;
return unescape(document.cookie.substring(offset, endstr));
}
// End -->
</SCRIPT>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<title>FIRST SEMESTER RESULT FOR <?php echo $row_students['student_name']; ?></title>
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
.style5 {
	color: #FFF;
	font-weight: bold;
	text-align: center;
}
.style6 {font-size: 14px}
.style15 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
.style17 {color: #000000; font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
.style19 {font-size: 15px}
.pageName .bodyText.style6 table {
	font-style: italic;
}
.RES {
	color: #0FF;
}
.bodyText table {
	color: #00F;
}
body {
	background-image: url();
	background-repeat: repeat;
}
-->
</style>
<link rel="stylesheet" type="text/css" media="print" href="styles/watermark-print-ie.css" /> 

<SCRIPT LANGUAGE="JavaScript">
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
</head>
<body OnLoad="printPage()">




<table width="80%" border="0"  background="transparent" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td bgcolor="#003366"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
  </tr>

 <tr>
    <td valign="top" bgcolor="#FFFFFF">  <img src="mm_spacer.gif" alt="" width="50" height="1" border="0" />
      <table width="900" border="5" align="center" cellpadding="5" cellspacing="5">
        <tr>
          <td width="376" class="pageName"><div align="center" class="bodyText style6">
  
            <p class="navText style19">The Federal Polytechnic Nasarawa <br />
              Examination Result<br />
              School of Applied Science<br />
              Department of Computer Science <br />
              <img src="images/house.png" width="100" height="100" /></p>
            <p class="navText style19">
              <marquee behavior="alternate">
                FIRST SEMESTER EXAMINATION RESULT</marquee>
            </p>
            <table width="100%" border="2" align="center" cellpadding="2" cellspacing="2">
              <tr>
                <td width="38%" class="navText"><span class="style15">STUDENT NAME </span></td>
                <td width="62%" class="navText"><span class="style17"><?php echo $row_students['student_name']; ?></span></td>
                </tr>
              <tr>
                <td class="navText"><span class="style15">MATRIC NUMBER</span></td>
                <td class="navText"><span class="style17"><?php echo $row_students['reg_no']; ?></span></td>
                </tr>
              <tr>
                <td class="navText"><strong>SCHOOL</strong></td>
                <td class="navText">APPLIED SCIENCE</td>
              </tr>
              <tr>
                <td class="navText"><strong>DEPARTMENT</strong></td>
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
          <td class="bodyText"><table width="100%" border="5" align="center" cellpadding="5" cellspacing="5" id="ttt">
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
      <p>
      <SCRIPT LANGUAGE="JavaScript">
if (window.print) {
document.write('<form> '
+ '<input type=button name=print value="Click" '
+ 'onClick="javascript:window.print()"> To Print Your Result</form>');
}
// End -->
        </script></p>
      <p>Any Score below 40 is equated to Carry Over.</p>
      <table width="165" border="2" align="left" cellpadding="2" cellspacing="2" id="navigation">
        <tr>
          <td width="165"><a href="<?php echo $logoutAction ?>" class="navText">Log Out</a></td>
        </tr>
      </table>
    <p>&nbsp;        </p></td>
  </tr>
</table>

</body>
</html>
<?php
((mysqli_free_result($students) || (is_object($students) && (get_class($students) == "mysqli_result"))) ? true : false);
?>
