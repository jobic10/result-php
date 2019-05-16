<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LOG OUT COMPLETED!</title>
<style type="text/css">
body,td,th {
	color: #0FF;
}
body {
	background-color: #000;
}
</style>
</head>

<body>
<h1 align="center">YOU HAVE SUCCESSFULLY LOG OUT
</h1>
<p><!--webbot bot="HTMLMarkup" startspan --><form name="redirect" method="post">
<center>
<b>You will be redirected to the homepage in<br /><br />
<form method="post">
<input type="text" size="3" name="redirect2">
</form>
seconds</b>
</center>

<script>
<!--


var targetURL="index.php"
//change the second to start counting down from
var countdownfrom=5


var currentsecond=document.redirect.redirect2.value=countdownfrom+1
function countredirect(){
if (currentsecond!=1){
currentsecond-=1
document.redirect.redirect2.value=currentsecond
}
else{
window.location=targetURL
return
}
setTimeout("countredirect()",1000)
}

countredirect()
//-->
</script>
<p>&nbsp;</p>
</body>
</html>