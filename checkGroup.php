<?php require_once('Connections/My_Con.php'); ?>
<?php


// Start the session
session_start();

$email = $_SESSION['email'];
$currLat = $_SESSION['currLat'];
$currLong = $_SESSION['currLong'];

echo $email;
echo $currLat;
echo $currLong;


/**/

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
$query_availGrps = "SELECT * FROM users,groups WHERE (groups.lat BETWEEN '$currLat'-0.1 AND '$currLat'+0.01) AND (groups.long BETWEEN '$currLong'-0.01 AND '$currLong'+0.01);";
$availGrps = mysql_query($query_availGrps, $My_Con) or die(mysql_error());
$row_availGrps = mysql_fetch_assoc($availGrps);
$totalRows_availGrps = mysql_num_rows($availGrps);

if(!$totalRows_availGrps){
	header('Location: LocationStep2.php');
	exit;
	
	}



?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<select name="availGrps">
  <?php
do {  
?>
  <option value="<?php echo $row_availGrps['grp_id']?>"><?php echo $row_availGrps['grp_name']?></option>
  <?php
} while ($row_availGrps = mysql_fetch_assoc($availGrps));
  $rows = mysql_num_rows($availGrps);
  if($rows > 0) {
      mysql_data_seek($availGrps, 0);
	  $row_availGrps = mysql_fetch_assoc($availGrps);
  }
?>
</select>
</body>
</html>
<?php
mysql_free_result($availGrps);
?>
