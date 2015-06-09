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

mysql_select_db($database_My_Con, $My_Con);
$query_userAuthenticate = "SELECT * FROM users";
$userAuthenticate = mysql_query($query_userAuthenticate, $My_Con) or die(mysql_error());
$row_userAuthenticate = mysql_fetch_assoc($userAuthenticate);
$totalRows_userAuthenticate = mysql_num_rows($userAuthenticate);
?>





<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
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
<link href="css/homeLayout.css" rel="stylesheet" type="text/css">
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
<script src="ResponsiveView/respond.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
</head>
<body>
<div class="gridContainer clearfix">
  <div id="header">
    <h1>Neighbours Social Network  </h1>
  </div>
  
  <div id="ErrorDisplay" style="color:red;display:none"><p id="errorDis" name="errorDis"></p></div>
  
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  
  <div id="description">
    <h2>Join Us Now</h2>
    <h2>It's Completely Free</h2>
  </div>
  <p>&nbsp;</p>
  <div id="login_box">
    <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" id="login">
        <p><span id="sprytextfield1">
          <input name="user" type="text" id="user" placeholder="Email"><br>
        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></p>
        <p>
          <input name="pass" type="password" id="pass" placeholder="Password">
        </p>
        <p>
          <input type="submit" name="login" class="login login-submit" value="login">
        </p>
    </form>

  <div class="login-help">
    <p><a href="loginForm.php">Register</a> • <a href="forgotPass.php">Forgot Password</a></p>
  </div>
  </div>
 
  

</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email", {validateOn:["blur"]});

function errorSubmit(){
		
		document.getElementById("ErrorDisplay").style.display = "block";
	   document.getElementById("errorDis").innerHTML = "TRY AGAIN !!!";
	
}


	
  </script>
  
  
  
 <?php 
 if (isset($_POST['user'])) {
	$encPass = $_POST['pass'];
	$compPass = md5($encPass);
  $loginUsername=$_POST['user'];
  $password=$compPass;
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "profile.php";
  //$MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_My_Con, $My_Con);
  
  $LoginRS__query=sprintf("SELECT Email, Password FROM users WHERE Email=%s AND Password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $My_Con) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
	 
	  echo '<script type="text/javascript">
	  	 
	  window.errorSubmit();
	


</script>';
	 
    //header("Location: ". $MM_redirectLoginFailed );
  }
}
 ?> 
 

</body>
</html>
<?php
mysql_free_result($userAuthenticate);
?>
