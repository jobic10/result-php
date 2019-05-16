
<?php require_once('Connections/conn.php'); ?>
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
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td colspan="2" bgcolor="#003366"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
  </tr>
 <tr>
    <td colspan="2" bgcolor="#003366"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
  </tr>

 <tr>
    <td valign="top" bgcolor="#FFFFFF"><img src="mm_spacer.gif" alt="" width="50" height="1" border="0" />
      <table border="0" cellspacing="0" cellpadding="0" width="305">
        <tr>
          <td class="pageName">Student Login  </td>
		</tr>

		<tr>
          <td class="bodyText"><form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
            <table width="275" border="0" cellpadding="0" cellspacing="0" bgcolor="#F4FFE4">
              <tr>
                <td><label>Reg. No. </label>
                  &nbsp;</td>
                <td><label>
                  <input name="regno" type="text" id="regno" size="20" />
                </label></td>
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
                <td><label></label></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="Submit" value="Check Result" /></td>
              </tr>
            </table>
                    </form>
          <p>&nbsp;</p>		</td>
        </tr>
      </table>
      </td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
((mysqli_free_result($sessions) || (is_object($sessions) && (get_class($sessions) == "mysqli_result"))) ? true : false);
?>
