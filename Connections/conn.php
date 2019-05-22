<?php
# FileName="Connection_php_mysql.htm"
# Type="mysql"
# HTTP="true"
$hostname_conn = "localhost";
$database_conn = "result";
$username_conn = "root";
$password_conn = "";

$conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($hostname_conn,  $username_conn,  $password_conn)) or trigger_error(mysqli_error($GLOBALS["___mysqli_ston"]),E_USER_ERROR); 
?>
<?php $who = "Developed By Owonubi Job Sunday (To change this, go to the Connection Folder and open conn.php or you can just search for conn.php, open the file and you will see me)"; ?>
