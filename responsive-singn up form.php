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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "send")) {
  $insertSQL = sprintf("INSERT INTO users (fullname, Password, Email, Phone, pobox, street, city) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['fullname'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['phone'], "int"),
                       GetSQLValueString($_POST['pobox'], "text"),
                       GetSQLValueString($_POST['street'], "text"),
                       GetSQLValueString($_POST['city'], "text"));

  mysql_select_db($database_My_Con, $My_Con);
  $Result1 = mysql_query($insertSQL, $My_Con) or die(mysql_error());

  $insertGoTo = "profile.php";
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


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" http-equiv="Content-Type" content="text/html; charset=utf-8" >
<title>Responsive Full Background Image</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="author" content="Six Revisions">
  <meta name="description" content="How to use the CSS background-size property to make an image fully span the entire viewport.">
  <link rel="icon" href="http://sixrevisions.com/favicon.ico" type="image/x-icon" />
  <link href="http://fonts.googleapis.com/css?family=Kotta+One|Cantarell:400,700" rel="stylesheet" type="text/css">
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- Not required: presentational-only.css only contains CSS for prettifying the demo -->
  <link rel="stylesheet" href="presentational-only/presentational-only.css">

  <!-- responsive-full-background-image.css stylesheet contains the code you want -->
  <link rel="stylesheet" href="responsive-full-background-image.css">
  <!---------- CSS ------------>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
  
  <!-- Not required: jquery.min.js and presentational-only.js is only used to demonstrate scrolling behavior of the viewport  -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="presentational-only/presentational-only.js"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
</head>



<body>
  
  <!--BEGIN #signup-form -->
    <div id="signup-form">
        
        <!--BEGIN #subscribe-inner -->
        <div id="signup-inner">
        
        	<div class="clearfix" id="header" style="text-align:center;">
        	
        		<img id="signup-icon" src="./images/signup.png" alt="" />
        		<h2>Sign Up</h2>

            
          </div>
			

            
          <form method="POST" name="send" id="send" action="<?php echo $editFormAction; ?>">
          
          
          
          
          
          
            	
                <p>

                <label for="fullname">Full Name*    
                  <input id="fullname" type="text" name="fullname" value="" required/>
                </label>
                </p>
                
                
                
            <p>

              <label for="email">Email *
                <input id="email" type="email" name="email" value="" required>
              </label>
            </p>
                
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
                
                
            <p>

              <label for="phone">Phone              
                <input id="phone" type="text" name="phone" value="" />
              </label>
            </p>
                <p>
                <label for="password">Password                
                  <input type="password" name="password" id="password">
                </label>
                <br>
                <br>
                <span id="spryconfirm1">
                <label for="confirmpassword">ConfirmPassword
                  <input type="password" name="confirmpassword" id="confirmpassword">
                </label>
                <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">The values don't match.</span></span></p>
                
                
                
                
                
                
                
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
        
        <!--END #signup-inner -->
        </div>
        
    <!--END #signup-form -->   
    </div>


  
  
  
  
  
      
      
      
   
<script type="text/javascript">
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password");
    </script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
