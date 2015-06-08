<?php require_once('Connections/My_Con.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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
}


?>
<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Neighbours Home</title>
<link href="ResponsiveView/boilerplate.css" rel="stylesheet" type="text/css">
<link href="css/homeLayout -forgot.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<!-- 
To learn more about the conditional comments around the html tags at the top of the file:
paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/

Do the following if you're using your customized build of modernizr (http://www.modernizr.com/):
* insert the link to your js here
* remove the link below to the html5shiv
* add the "no-js" class to the html tags at the top
* you can also remove the link to respond.min.js if you included the MQ Polyfill in your modernizr build 
-->
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<style>
#correctEmail{
	color:green;
	
	}
	
#inCorrectEmail{
	color:red;
	
	}

</style>


<script src="ResponsiveView/respond.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
</head>
<body>
<div class="gridContainer clearfix">
  <div id="header">
    <h1>Neighbours Social Network  </h1>
  </div>
 
  <div id="wrapper1"><div id="description">
    <h2>Find Your Account</h2>
    <h3>Enter your Email</h3>
  </div>
 
  <div id="login_box">
    <form METHOD="POST" id="login">
        <p><span id="sprytextfield1">
          <input name="email" type="text" id="email" placeholder="Email"><br><br>
       
      
          <input type="submit" id="login" name="login" class="login login-submit" value="Search">
       
          <input onClick="window.location.href='index.php'" type="button" name="cancel" value="Cancel">
        
        
    </form>

  
  </div></div>

 
  <div id="alertSec"><?php if (isset($_POST['login'])) {
mysql_select_db($database_My_Con, $My_Con);
$checkEmail = $_POST['email'];
$query_emailAuth = "SELECT users.Email FROM users WHERE Email = '$checkEmail'";
$emailAuth = mysql_query($query_emailAuth, $My_Con) or die(mysql_error());
$row_emailAuth = mysql_fetch_assoc($emailAuth);
$totalRows_emailAuth = mysql_num_rows($emailAuth);



 if($totalRows_emailAuth){
	 //send mail section
	 
	$email_from = 'rangaranasingha@gmail.com';//<== Put your email address here
	$email_subject = "Change of Passwords";
	$email_body = "Click <a href='https://www.google.lk/'>here to change your password";
		
		 
	$to = $checkEmail;//<== Put your email address here
	$headers = "From: $email_from \r\n";
	 
	//Send the email!
	mail($to,$email_subject,$email_body,$headers);
	 
	 
	 
	 //display message
	 echo "<div id='correctEmail'>Password reset link has been sent to your Email (".$to.") </div>";
		 
		 
		 
		 
		 
	 }else{
		 echo "<div id='inCorrectEmail'>No such User!!!</div>";
		 }

}?></div>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email", {validateOn:["blur"]});

function errorSubmit(){
	alert("Wrong Username or Password???");
	
	}
  </script>
  
  
  <script type="text/javascript">
function invalidPass(){
alert("errorrrr");  
}
  </script>
</body>
</html>

