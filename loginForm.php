<?php require_once('Connections/My_Con.php'); ?>
<?php
// Start the session
session_start();


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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "send")) {
	/*send email & city variables via Session*/
	
	$_SESSION['email']=$_POST['email'];
	$_SESSION['city']=$_POST['city'];
	
	/**/
	
	
	
	
	$encPass = $_POST['password'];
$sendEncPass = md5($encPass);
	
	
  $insertSQL = sprintf("INSERT INTO users (fullname, Password, Email, Phone, pobox, street, city) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['fullname'], "text"),
                       GetSQLValueString($sendEncPass, "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['phone'], "int"),
                       GetSQLValueString($_POST['pobox'], "text"),
                       GetSQLValueString($_POST['street'], "text"),
                       GetSQLValueString($_POST['city'], "text"));

  mysql_select_db($database_My_Con, $My_Con);
  $Result1 = mysql_query($insertSQL, $My_Con) or die(mysql_error());

  $insertGoTo = "getLocation_res.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_My_Con, $My_Con);
$query_Recordset1 = "SELECT * FROM users";
$Recordset1 = mysql_query($query_Recordset1, $My_Con) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
<title>Sample Template</title>
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
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>


 <!---------- CSS ------------>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
  <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
  
  
  
  
  
  
</head>
<body>
<div class="gridContainer clearfix">
 <div id="wrapper">
<!--BEGIN #signup-form -->
  <div id="signup-form">
        
        <!--BEGIN #subscribe-inner -->
    <div id="signup-inner">
    
   	  <div class="clearfix" id="header" style="text-align:center;">      	
        		<img id="signup-icon" src="images/signup.png" alt="" align="right" />
       		  <h2>Sign Up</h2>
            </div>
			

            
            <form method="POST" name="send" id="send" action="<?php echo $editFormAction; ?>">
                <p>
                <label for="fullname">Full Name*    
                  <input id="fullname" type="text" name="fullname" value="" required/>
                </label>
                </p>
                
                
                
            <p><span id="sprytextfield4">
            <label for="email2">Email *
              <input id="email2" type="text" name="email" value="" required>
            </label><br>
            <span class="textfieldRequiredMsg">Required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span>
            </span></p>
                
            <p>
              <label for="pobox">Po Box
                <input name="pobox" type="text" id="pobox" value="">
              </label>
            </p>
                
                <p>
                <label for="street">Street
                  <input name="street" type="text" id="street" value="">
                </label>
              </p>
                
                
              <p>
                <label for="city">City
                  <input name="city" type="text" id="city" value="">
                </label>
              </p>
                
                
            <p><span id="sprytextfield3">
            <label for="phone">Phone
              <input id="phone" type="text" name="phone" value="" />
            </label><br>
            <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format
            </span>
            </span></p>
                <p>
                <label for="password">Password
                  <input type="password" name="password" id="password">
                </label>
                <br>
                <br>
                <span id="spryconfirm1">
                <label for="confirmpassword">ConfirmPassword
                  <input type="password" name="confirmpassword" id="confirmpassword">
                </label><br>
            <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">Values Unmatch.
            </span>
            </span></p>
                <p>
                <button id="submit" type="submit">Submit</button>
                </p>
                <input type="hidden" name="MM_insert" value="send">    
          </form>
            
		<div id="required">
        <p>* Required Fields<br/>
		</p>
		</div>
    </div>
        
      <p>
    <!--END #signup-inner --></p>
  </div>
        
    <!--END #signup-form -->   
 </div>
</div>

  
</div>
<script type="text/javascript">
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password", {validateOn:["change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "phone_number", {format:"phone_custom", pattern:"0000000000", validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
