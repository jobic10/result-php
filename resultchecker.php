<?php require_once('Connections/conn.php'); 
error_reporting(0);


?>
<?php
function redirect($url) {
    if(!headers_sent()) {
        //If headers not sent yet... then do php redirect
        header('Location: '.$url);
        exit;
    } else {
        //If headers are sent... do javascript redirect... if javascript disabled, do html redirect.
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>';
        exit;
    }
}
?>
<?php

mysqli_select_db( $conn, $database_conn);

$query_sessions = "SELECT * FROM sessions";
$sessions = mysqli_query( $conn, $query_sessions) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$row_sessions = mysqli_fetch_assoc($sessions);
$totalRows_sessions = mysqli_num_rows($sessions);

$editFormAction = $_SERVER['PHP_SELF'];

$reg_no=$_POST['regno'];
$sem=$_POST['semester'];

if (isset($reg_no)){
// How to use
if ($sem=='1ST SEMESTER'){
	$url = "rs1.php?regno=".$reg_no;
	redirect($url);
	}
elseif ($sem=='2ND SEMESTER'){
	$url = "rs2.php?regno=".$reg_no;
	redirect($url);
	}
elseif ($sem=='CUMMULATIVE'){
	$url = "rs3.php?regno=".$reg_no;
	redirect($url);
	}

}

?>
<!DOCTYPE html>


<!-- Website designed by Owonubi Job Sunday -->
<html>
<head>
	<meta charset="UTF-8">
	<title>ONLINE RESULT BOARD.</title>
	<link rel="stylesheet" href="css2/style.css" type="text/css"><style>

div.jkcubeslideshow{ /* main container */
	background: white;
	display: block;
	width: 300px; /* default width of main container */
	height: 375px; /* default height of main container */
	position: relative;
	-webkit-perspective: 1000px; /* Greater the value, less pronounced the 3D effect */
	perspective: 1000px; /* Greater the value, less pronounced the 3D effect */;
}

div.side1, div.side2 { /* two panels that make up cube effect */
	width: 100%;
	height: 100%;
	position: absolute;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	backface-visibility: hidden; /* hide backface of DIVs */
	transition: all 1s ease-in-out; /* CSS transition. Actual duration set by script */;
}

div.side1 img, div.side2 img { /* how should slideshow images be sized inside panels? */
	width: 100%;
	height: auto;
}


    </style>
<style type="text/css">
<!--
.style2 {color: #FFFFFF}
.style3 {color: #000000}
.accepted {
	color: #00F;
}
.rejected {
	color: #F00;
	text-decoration: line-through;
}
.not {
}
#body div form {
	font-size: 16px;
	font-style: italic;
}
-->
</style>

<script src="jquery.min.js"></script>

<script src="jkcubeslideshow.js">

/* =====================================
 ** 3D Cube Slideshow- by JavaScript Kit (www.javascriptkit.com)
 ** Visit JavaScript Kit at http://www.javascriptkit.com/ for full source code
===================================== */

</script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryEffects.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script>
var cubeshowvar1, cubeshowvar2

jQuery(function($){
	

	cubeshowvar2 = new jkcubeslideshow({
		id: 'cubeshow2',
		dimensions: [200, 200],
		pause: 2000,
		images: [
							['food1.png', '#'],
							['food2.png', ],
							['food3.png', ],
							['food4.png', ]
						]
	})

})
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
function MM_effectShake(targetElement)
{
	Spry.Effect.DoShake(targetElement);
}
function MM_effectSquish(targetElement)
{
	Spry.Effect.DoSquish(targetElement);
}

function MM_effectSlide(targetElement, duration, from, to, toggle)
{
	Spry.Effect.DoSlide(targetElement, {duration: duration, from: from, to: to, toggle: toggle});
}
</script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="header">
		<div>
		  <ul>
		          <li >
                    <a href="index.php">Home</a>
        </li>
                <li class="selected">
                    <a href="resultchecker.php">Check Result</a>
            </li>
                <li>
                    <a href="lecturer_login.php">Lecturer's Login</a>
            </li>
                <li>
                    <a href="admin_login.php">Admin Login</a>
            </li>
                
		  </ul>
	  </div>
</div>
	<div id="body" class="home">
	  <div>
	    <h3><script src="jquery.min.js"></script>

<script src="jkcubeslideshow.js">


</script>

<script>

var cubeshowvar1, cubeshowvar2

jQuery(function($){
	

	cubeshowvar2 = new jkcubeslideshow({
		id: 'cubeshow2',
		dimensions: [200, 200],
		pause: 2000,
		images: [
							['food1.png', '#'],
							['food2.png', ],
							['food3.png', ],
							['food4.png', ]
						]
	})

})

</script>

</head>

<body>

<div>
  <!--ZOOMSTOP-->
  
  
  <!-- BuySellAds Ad Code -->
  <script type="text/javascript">
(function(){
  var bsa = document.createElement('script');
     bsa.type = 'text/javascript';
     bsa.async = true;
     bsa.src = '../../../s3.buysellads.com/ac/bsa.js';
  (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);
})();
</script>
  <!-- End BuySellAds Ad Code -->
  
  <script type="text/javascript" src="dropdowntabs.js">
</script></div>
</h3>
	    <form name="form2" method="post" action="">
	      Ensure your matric number is typed in uppercase 
        </form>
	    <h3>
	      <table>
        <td width="858" class="pageName">&nbsp;</td>
          </tr>
	        
        <tr>
          <td class="bodyText"><form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
              <table width="856" border="8" cellpadding="5" cellspacing="10" bgcolor="#F4FFE4">
                <tr>
                  <td width="172"><label>Matric Number</label>&nbsp;</td>
                  <td width="378"><label>
	                  <input type="text" name="regno"  size="30">
                  </label></td>
                  <td width="214" rowspan="5"><div class="jkcubeslideshow" id="cubeshow2">
                  <div align="left"></td>
                </tr>
               
                <tr>
                  <td><label>Session:</label>
                  &nbsp;</td>
                  <td><label>
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
                <tr>
                  <td><label>Semester:</label>
                  &nbsp;</td>
                  <td><select name="semester" id="semester">
	                  <option value="1ST SEMESTER">1ST SEMESTER</option>
	                  <option value="2ND SEMESTER">2ND SEMESTER</option>
	                  <option value="CUMMULATIVE">CUMMULATIVE</option>
                  </select></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><input type="submit" name="Submit" value="Check Result" />
                    <input name="reset" type="reset" id="reset" onClick="MM_popupMsg('Matric Number field has been cleared!');MM_effectShake('form1')" value="Reset" />
                  <input name="cancel" type="button" id="cancel" onClick="MM_popupMsg('Confirm');MM_effectSquish('form1');MM_effectSquish('form5')" value="Cancel" /></td>
                </tr>
              </table>
              </form>
          <p>&nbsp;</p>		</td>
        </tr>
        </table>
        </h3>
		  <h3>&nbsp;</h3>
<form id="form5" name="form5"  >
  <input name="cancel3" type="button" id="cancel3" onClick="MM_effectSlide('form1', 1000, '100%', '0%', false)" value="Slide Up" />
  <input name="cancel4" type="button" id="cancel4" onClick="MM_effectSlide('form1', 1000, '0%', '100%', false)" value="Slide Down" />
</form>
		  <p>&nbsp;</p>
		  <p>&nbsp;</p>
		  <p>Disclaimer:</p>
		  <p> The result given is correct at   the time of release of the result by the department which accepts no   responsibility thereafter for errors or omissions caused as a result of   their transmission via the Internet or their downloading or printing by   the user. No material from this web site can be copied, reproduced,   published, uploaded, posted, transmitted or distributed or dealt with in   any manner, unless expressly authorized. Students are not permitted to   change, modify or prepare derivative works from the content of this   site. For any clarifications or confirmation please address your   enquiries to Examination Officer, The Federal Polytechnic Nasarawa, School of Applied Science, Department of Computer Science. </p>
	  </div>
</div>
<div id="footer">
		<div>
			<p>
				&#169; <?php
                
                  echo date('Y');
                
                ?>
                . All Rights Reserved</p></div>
</div>

</body>
</html>
<?php
((mysqli_free_result($sessions) || (is_object($sessions) && (get_class($sessions) == "mysqli_result"))) ? true : false);
?>
