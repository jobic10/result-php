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

$stud_regno=$_GET['regno'];

if (isset($stud_regno)){
mysqli_select_db( $conn, $database_conn);
$query_students = "SELECT * FROM students WHERE reg_no='$stud_regno'";
$students = mysqli_query( $conn, $query_students) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$row_students = mysqli_fetch_assoc($students);
$totalRows_students = mysqli_num_rows($students);
}

$editFormAction = $_SERVER['PHP_SELF'];

$course=$_POST['course_name'];
if (isset($course)){
mysqli_select_db( $conn, $database_conn);
$query_course = "SELECT * FROM courses WHERE course_name='$course'";
$course = mysqli_query( $conn, $query_course) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$row_course = mysqli_fetch_assoc($course);
$totalRows_course = mysqli_num_rows($course);

$code=$row_course['course_code'];
$credit_unit=$row_course['credit_unit'];
}

if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO scores (reg_no,`session`, semester, course_code, course_name, cu, scores) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($stud_regno, "text"),
                       GetSQLValueString($_POST['session'], "text"),
                       GetSQLValueString($_POST['semester'], "text"),
                       GetSQLValueString($code, "text"),
                       GetSQLValueString($_POST['course_name'], "text"),
                       GetSQLValueString($credit_unit, "int"),
                       GetSQLValueString($_POST['scores'], "double"));

  mysqli_select_db( $conn, $database_conn);
  $Result1 = mysqli_query( $conn, $insertSQL) or die(mysqli_error($GLOBALS["___mysqli_ston"]));

  $insertGoTo = "assess.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysqli_select_db( $conn, $database_conn);
$query_sessions = "SELECT * FROM sessions";
$sessions = mysqli_query( $conn, $query_sessions) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$row_sessions = mysqli_fetch_assoc($sessions);
$totalRows_sessions = mysqli_num_rows($sessions);

mysqli_select_db( $conn, $database_conn);
$query_courses = "SELECT * FROM courses";
$courses = mysqli_query( $conn, $query_courses) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$row_courses = mysqli_fetch_assoc($courses);
$totalRows_courses = mysqli_num_rows($courses);

mysqli_select_db( $conn, $database_conn);
$query_scores = "SELECT * FROM scores WHERE reg_no='$stud_regno'";
$scores = mysqli_query( $conn, $query_scores) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$row_scores = mysqli_fetch_assoc($scores);
$totalRows_scores = mysqli_num_rows($scores);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<title>The Federal Polytechnic Nasarawa ~ Computer Science Online Result Board</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="mm_travel2.css" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>

<script language="JavaScript" type="text/javascript">
//--------------- LOCALIZEABLE GLOBALS ---------------
var d=new Date();
var monthname=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
//Ensure correct for language. English is "January 1, 2004"
var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
//---------------   END LOCALIZEABLE   ---------------
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
</script>
<style type="text/css">
<!--
.style2 {color: #FFFFFF}
.style3 {color: #000000}
.style5 {color: #FFFFFF; font-weight: bold; }
.spec {
	color: #F00;
}
-->
</style>
<script type="text/javascript">
function confirmation()
{
   alert("You have entered score for <?php echo $row_students['student_name']; ?> with matric number <?php echo $row_students['reg_no']; ?>");
  
}
function MM_setTextOfTextfield(objId,x,newText) { //v9.0
  with (document){ if (getElementById){
    var obj = getElementById(objId);} if (obj) obj.value = newText;
  }
}
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
</script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
</head>
<body bgcolor="#ffffff">

<style type="text/css">
</style>
<script language="JavaScript1.2">

var x,y
var kern=20 
var flag=0
var message=""
message=message.split("")
var xpos=new Array()
for (i=0;i<message.length;i++) {
	xpos[i]=-50
	}
var ypos=new Array()
for (i=0;i<message.length;i++) {
	ypos[i]=-50
	}
function handlerMM(e){
	x = (e) ? e.pageX : document.body.scrollLeft+event.clientX
	y = (e) ? e.pageY : document.body.scrollTop+event.clientY
	flag=1
	}
function makebanner() {
	if (flag==1) {
		for (i=message.length-1; i>=1; i--) {
			xpos[i]=xpos[i-1]+kern
			ypos[i]=ypos[i-1]
			}
		xpos[0]=x+kern
		ypos[0]=y
		for (i=0; i<message.length; i++) {
			if (document.getElementById) {
				var thisspan = document.getElementById("span"+i).style
				} else {
				var thisspan = eval((document.layers)?"document.span"+i:"span"+(i)+".style")
				}
			if (thisspan.posLeft) {
				thisspan.posLeft=xpos[i]
				thisspan.posTop=ypos[i]
				}
			if (!thisspan.posLeft) {
				thisspan.left=xpos[i]
				thisspan.top=ypos[i]
				}
			}
		}
		var timer=setTimeout("makebanner()",30)
	}
window.onload=makebanner;
</script>



<script language="JavaScript1.2">
for (i=0;i<message.length;i++) {
document.write("<span id='span"+i+"' class='spanstyle'>")
document.write(message[i])
document.write("</span>")
}
if (document.layers){
document.captureEvents(Event.MOUSEMOVE);
}
document.onmousemove = handlerMM;

</script>

<style type="text/css">
<!--
.spanstyle {
position:absolute;
visibility:visible;
top:-50px;
font-size:10pt;
font-family:Verdana;
font-weight:italic;
color:808066;
}
BODY {
width:100%;overflow-x:hidden;overflow-y:scroll;
}
-->
</style>
<script language="JavaScript1.2">

var x,y
var kern=20 
var flag=0
var message="Any score entered can not be edited"
message=message.split("")
var xpos=new Array()
for (i=0;i<message.length;i++) {
	xpos[i]=-50
	}
var ypos=new Array()
for (i=0;i<message.length;i++) {
	ypos[i]=-50
	}
function handlerMM(e){
	x = (e) ? e.pageX : document.body.scrollLeft+event.clientX
	y = (e) ? e.pageY : document.body.scrollTop+event.clientY
	flag=1
	}
function makebanner() {
	if (flag==1) {
		for (i=message.length-1; i>=1; i--) {
			xpos[i]=xpos[i-1]+kern
			ypos[i]=ypos[i-1]
			}
		xpos[0]=x+kern
		ypos[0]=y
		for (i=0; i<message.length; i++) {
			if (document.getElementById) {
				var thisspan = document.getElementById("span"+i).style
				} else {
				var thisspan = eval((document.layers)?"document.span"+i:"span"+(i)+".style")
				}
			if (thisspan.posLeft) {
				thisspan.posLeft=xpos[i]
				thisspan.posTop=ypos[i]
				}
			if (!thisspan.posLeft) {
				thisspan.left=xpos[i]
				thisspan.top=ypos[i]
				}
			}
		}
		var timer=setTimeout("makebanner()",12)
	}
window.onload=makebanner;
</script>



<script language="JavaScript1.2">
for (i=0;i<message.length;i++) {
document.write("<span id='span"+i+"' class='spanstyle'>")
document.write(message[i])
document.write("</span>")
}
if (document.layers){
document.captureEvents(Event.MOUSEMOVE);
}
document.onmousemove = handlerMM;

</script>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#3366CC">
    <td colspan="3" rowspan="2" bgcolor="#000000"><img src="images/logo.png" width="146" height="139" /></td>
    <td height="63" colspan="3" align="center" valign="bottom" nowrap="nowrap" bgcolor="#000000" id="logo"><div align="left"><strong>STUDENT RESULT BOARD</strong></div></td>
    <td width="97" bgcolor="#000000">&nbsp;</td>
  </tr>

  <tr bgcolor="#3366CC">
    <td height="64" colspan="3" align="center" valign="top" bgcolor="#000000" id="tagline"><div align="left"><strong>COMPUTER SCIENCE DEPT, The Federal Polytechnic Nasarawa </strong></div></td>
	<td width="97" bgcolor="#000000">&nbsp;</td>
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
	<table border="0" cellspacing="0" cellpadding="0" width="135" id="navigation">
        <tr>
          <td width="135">&nbsp;<br />
		 &nbsp;<br /></td>
        </tr>
        <tr>
          <td width="135"><a href="lecturer_main.php" class="navText">Home</a></td>
        </tr>
        <tr>
          <td width="135"><a href="assessment.php" class="navText">Assessment</a></td>
        </tr>
        <tr>
          <td width="135"><a href="results.php" class="navText">Result </a></td>
        </tr>
        <tr>
          <td width="135"><a href="<?php echo $logoutAction ?>" class="navText">Log Out </a></td>
        </tr>
      </table>
 	 <br />
  	&nbsp;<br />
  	&nbsp;<br />
  	&nbsp;<br /></td>
    <td colspan="4"><p><img src="mm_spacer.gif" alt="" width="305" height="1" border="0" /><br />
      &nbsp;<br />
      &nbsp;<br />
    </p>
    
      <p align="center">You are currently trying to enter the scores for <strong><?php echo $row_students['student_name']; ?></strong> with the matric number <strong><?php echo $row_students['reg_no']; ?></strong></p>
      <table border="0" cellspacing="0" cellpadding="0" width="596">
        <tr>
          <td width="596" class="pageName">Studsent Assessment </td>
        </tr>
        
        <tr>
          <td height="250" class="bodyText"><table width="100%" border="5" cellspacing="5" cellpadding="5">
            <tr>
              <td width="40%"><strong>STUDENT NAME </strong></td>
              <td width="60%"><span class="style3"><strong><?php echo $row_students['student_name']; ?></strong></span></td>
              </tr>
            <tr>
              <td><strong>MATRIC NUMBER</strong></td>
              <td><span class="style3"><strong><?php echo $row_students['reg_no']; ?></strong></span></td>
              </tr>
            </table>
            <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
              
                
                  <table width="592" border="5" align="left" cellpadding="5" cellspacing="5">
                    
                    <tr valign="baseline">
                      <td width="164" align="right" nowrap><div align="left">Session:</div></td>
                      <td width="380"><label>
                        <select name="session" id="session">
                          <?php
do {  
?>
                          <option value="<?php echo $row_sessions['session']?>"><?php echo $row_sessions['session']?></option>
                          <?php
} while ($row_sessions = mysqli_fetch_assoc($sessions));
  $rows = mysqli_num_rows($sessions);
  if($rows > 0) {
      mysqli_data_seek($sessions,  0);
	  $row_sessions = mysqli_fetch_assoc($sessions);
  }
?>
                        </select>
                      </label></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right"><div align="left">Semester:</div></td>
                      <td><select name="semester" id="semester">
                        <option value="1ST SEMESTER">1ST SEMESTER</option>
                        <option value="2ND SEMESTER">2ND SEMESTER</option>
                      </select></td>
                    </tr>
                    
                    <tr valign="baseline">
                      <td nowrap align="right"><div align="left">Course Name:</div></td>
                      <td><select name="course_name" id="course_name">
                        <?php
do {  
?>
                        <option value="<?php echo $row_courses['course_name']?>"><?php echo $row_courses['course_name']?></option>
                        <?php
} while ($row_courses = mysqli_fetch_assoc($courses));
  $rows = mysqli_num_rows($courses);
  if($rows > 0) {
      mysqli_data_seek($courses,  0);
	  $row_courses = mysqli_fetch_assoc($courses);
  }
?>
                        </select></td>
                    </tr>
                    
                    <tr valign="baseline">
                      <td nowrap align="right"><div align="left">Scores:</div></td>
                    <td><span id="sprytextfield1">
                        <label for="scores"></label>
                        <input name="scores" type="text" id="scores" onclick="MM_setTextOfTextfield('sco','','Please Enter The Right Score!')" value="" />
                      <span class="textfieldRequiredMsg">Score is required.</span><span class="textfieldInvalidFormatMsg">Invalid Score.</span><span class="textfieldMinValueMsg">The entered score is less than the minimum required.</span><span class="textfieldMaxValueMsg">The entered score is greater than the maximum allowed, Please contact the head of dept.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right"><div align="left">Please Confirm Scores:</div></td>
                    <td><span id="spryconfirm1">
                        <label for="ConfirmScore"></label>
                        <input name="ConfirmScore" type="text" id="ConfirmScore" onclick="MM_setTextOfTextfield('sco','','Enter The Same Score To Be Sure!')" />
                      <span class="confirmRequiredMsg">Score is required.</span><span class="confirmInvalidMsg">The Scores don't match.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right"><font color="#FF0000">
                        <h1>Instruction</h1></font></td>
                      <td><label for="sco"></label>
                      <input name="sco" type="text" id="sco" onclick="MM_setTextOfTextfield('sco','','Please Cross Check All Entries!')" size="70" readonly="readonly" /></td>
                    </tr>
                    <tr valign="baseline">
                      <td colspan="2" align="right" nowrap><p align="center"><font color="#0000FF">Please Cross Check All The Details Above.</font></p>
                      <p align="center"> Before attempting to click any button, please read the caption next to it.</p></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right"><input type="submit" onclick="MM_validateForm('scores','','RinRange1:99');return document.MM_returnValue"   value="Assess" /></td>
                      <td>The Assess Button Will Save All The Details Entered Above </td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right"><input name="Reset" type="reset" onclick="MM_popupMsg('Reset Done!')"   value="Reset" /></td>
                      <td>The Reset Button will clear the entered score</td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap align="right"><input name="Reset2" type="button"   value="Cancel" /></td>
                      <td>Click On this button <font color="#FF0000">ONLY</font> when you are through with assessment</td>
                    </tr>
              </table>
  <input type="hidden" name="MM_insert" value="form1">
                
            </form>            </td>
        </tr>
      </table>
       <img src="mm_spacer.gif" alt="" width="50" height="1" border="0" /></td>
    <td colspan="2" valign="top"><p><br />
        &nbsp;Hello, here is the most serious part of the result board because here is what the web developers script will use to calculate the result.</p>
  <p class="spec"><strong>Please take note of the following:</strong></p>
  <ol>
    <li>Ensure that the student name is correct</li>
    <li>Ensure that the matric number is correct</li>
    <li>Click the Academic session (Very Serious)</li>
    <li>Ensure that you are not filling the wrong semester</li>
    <li>Ensure that the course/score are correct</li>
    </ol>
  <p>You will not be able to change any wrong entries except the database admin (Fantastic4 Team) are called.</p>
  <p>Once you click the Assess button it automatically save the entered values even if the fields are empty so ensure that you cross check before clicking on the Assess button</p></td>
  </tr>
  <tr>
    <td width="165" bgcolor="#000000">&nbsp;</td>
    <td width="55" bgcolor="#000000">&nbsp;</td>
    <td width="5" bgcolor="#000000">&nbsp;</td>
    <td width="411" bgcolor="#000000"><p align="center"><span class="style3">Webmasters:</span><br />
      <span class="style2"><?php echo $who; ?>
     -<br />
     -      </span></p>    </td>
    <td width="131" bgcolor="#000000">&nbsp;</td>
    <td width="173" bgcolor="#000000">&nbsp;</td>
	<td width="97" bgcolor="#000000">&nbsp;</td>
  </tr>
</table>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {hint:"From 0-99", validateOn:["blur", "change"], minValue:0, maxValue:99, useCharacterMasking:true});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "scores", {validateOn:["blur", "change"]});
</script>
</body>
</html>
<?php
((mysqli_free_result($students) || (is_object($students) && (get_class($students) == "mysqli_result"))) ? true : false);

((mysqli_free_result($sessions) || (is_object($sessions) && (get_class($sessions) == "mysqli_result"))) ? true : false);

((mysqli_free_result($courses) || (is_object($courses) && (get_class($courses) == "mysqli_result"))) ? true : false);

((mysqli_free_result($scores) || (is_object($scores) && (get_class($scores) == "mysqli_result"))) ? true : false);
?>
