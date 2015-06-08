<?php require_once('Connections/My_Con.php'); ?>
<?php
// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);


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
$query_getCurrGrps = "SELECT * FROM groups WHERE 1";
$getCurrGrps = mysql_query($query_getCurrGrps, $My_Con) or die(mysql_error());
$row_getCurrGrps = mysql_fetch_assoc($getCurrGrps);
$totalRows_getCurrGrps = mysql_num_rows($getCurrGrps);mysql_select_db($database_My_Con, $My_Con);
$query_getCurrGrps = "SELECT * FROM groups WHERE 1";
$getCurrGrps = mysql_query($query_getCurrGrps, $My_Con) or die(mysql_error());
$row_getCurrGrps = mysql_fetch_assoc($getCurrGrps);
$totalRows_getCurrGrps = mysql_num_rows($getCurrGrps);








header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($getCurrGrps)){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("grp_id",$row['grp_id']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("long", $row['long']);
  $newnode->setAttribute("grp_name", $row['grp_name']);
  $newnode->setAttribute("grp_radius", $row['grp_radius']);
}

echo $dom->saveXML();


mysql_free_result($getCurrGrps);
?>
