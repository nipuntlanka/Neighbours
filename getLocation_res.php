<?php require_once('Connections/My_Con.php'); ?>
<?php
// Start the session
session_start();

$email = $_SESSION['email'];
$city = $_SESSION['city'] . "srilanka";


echo $email;
echo $city;




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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formMain")) {
	$_SESSION['currLat'] = $_POST['currLat'];
	$_SESSION['currLong'] = $_POST['currLong'];
	
	
  $updateSQL = sprintf("UPDATE users SET lat=%s, `long`=%s WHERE Email='$email'",
                       GetSQLValueString($_POST['currLat'], "double"),
                       GetSQLValueString($_POST['currLong'], "double"));

  mysql_select_db($database_My_Con, $My_Con);
  $Result1 = mysql_query($updateSQL, $My_Con) or die(mysql_error());

  $updateGoTo = "checkGroup.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}



mysql_select_db($database_My_Con, $My_Con);

$query_getLoca = "SELECT userlocation.lat, userlocation.long FROM userlocation INNER JOIN users ON users.User_ID=userlocation.User_ID WHERE users.Email = '$email';";
$getLoca = mysql_query($query_getLoca, $My_Con) or die(mysql_error());
$row_getLoca = mysql_fetch_assoc($getLoca);
$totalRows_getLoca = mysql_num_rows($getLoca);





?>
<html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Untitled Document</title>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiGk8WenReo5hdM4-hK7ppcvAnsCLQUdc"></script>

<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="css/getLocation_ews.css" rel="stylesheet" type="text/css">
<link href="css/homeLayout.css" rel="stylesheet" type="text/css">
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
<script src="respond.min.js"></script>
<script type="text/javascript">
/**/
var geocoder;
var map;
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(cenLat,cenLong);
  var mapOptions = {
    zoom: 15,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map'), mapOptions);
  
  
}

function codeAddress() {
	initialize();
	
  var address = document.getElementById('address').value + "srilanka";
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
	  var currCenter = results[0].geometry.location;
	  
	   var image = {
					url: 'images/marker.png',
					// This marker is 20 pixels wide by 32 pixels tall.
					size: new google.maps.Size(100, 100),
					// The origin for this image is 0,0.
					origin: new google.maps.Point(0,0),
					// The anchor for this image is the base of the flagpole at 0,32.
					anchor: new google.maps.Point(85,98)
				  };
      var marker = new google.maps.Marker({
          map: map,
          position: currCenter,
		  icon: image,
		  draggable:true
      });
	  /*****************************************   EVENT LISTNERS   ****************************************************/
	  	     // Add an event listener on the marker.
		  google.maps.event.addListener(marker, 'drag', function(event){
			
			  var curLat = this.getPosition().lat();
				var curLong = this.getPosition().lng();;
				
			 
			 	setLatLong(curLat,curLong);
			
			
				//event.stopPropagation();
			  
		  });
	  setLatLong(currCenter.lat(),currCenter.lng());
	
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}


/**/
function setLatLong(lat,long){
				document.getElementById("currLat").value = lat;
				document.getElementById("currLong").value = long;
				}



/*global variable define*/
var city = <?php echo json_encode($city); ?>;
var cenLat;
var cenLong;


    function load() {

			/**/
	
	geoCodeSet(city);
	
	
		function geoCodeSet(addr){
			
			var geocoder =  new google.maps.Geocoder();
		
    		geocoder.geocode( { 'address': addr}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
			  cenLat = results[0].geometry.location.lat();
			  cenLong = results[0].geometry.location.lng();
			  
			  loadMap(cenLat,cenLong);
			  
            //alert("location : " +city +" - "+ results[0].geometry.location.lat() + " " +results[0].geometry.location.lng()); 
          } else {
            alert("Something got wrong " + status);
          }
        });
		}
		/**/
		
		
		
		
		
		
		
	function loadMap(lat,long){	
		
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(lat,long),
        zoom: 15,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;
	  
	  
	
	  
	  /********************draggable Marker definition on map-canvas****************/
	  
			
		
				//dynamic main marker define
				  var image = {
					url: 'images/marker.png',
					// This marker is 20 pixels wide by 32 pixels tall.
					size: new google.maps.Size(100, 100),
					// The origin for this image is 0,0.
					origin: new google.maps.Point(0,0),
					// The anchor for this image is the base of the flagpole at 0,32.
					anchor: new google.maps.Point(85,98)
				  };
				  
				  var currCenter = new google.maps.LatLng(lat,long);
				
				var dy_marker = new google.maps.Marker({
				map: map,
				position:currCenter,
				draggable:true,
				icon: image,
				zIndex:11,
				
			  });
/*****************************************   EVENT LISTNERS   ****************************************************/
	
		    // Add an event listener on the dy_marker.
		  google.maps.event.addListener(dy_marker, 'drag', function(event){
			
			  var curLat = this.getPosition().lat();
				var curLong = this.getPosition().lng();;
				
			 
			 	setLatLong(curLat,curLong);
			
			
				//event.stopPropagation();
			  
		  });
		  
	
		  
		  
	  /****************************************************************************************************/
			  

			  
			  
			  setLatLong(currCenter.lat(),currCenter.lng());
			  
			  bindMainInfoWindow(dy_marker, map, infoWindow, adminLoc);

		  
	}
		
}

	


</script>
<style type="text/css">
   html,body{
	   width:100%;
	   padding:2px;
	   }
   #maap {
	height: 60%;
	width: 98%;
	margin-left: 1%;
	padding: 0px;
	border: solid;
	border-width: 1px;
      }
	</style>
<link href="css/getLocation_ews.css" rel="stylesheet" type="text/css">
</head><body onLoad="load()">
<div class="gridContainer clearfix">
  <div id="header">
    <h1>Set Your Location</h1>
  </div>
  <div id="map"></div>
<div id="submitSection">
<form action="<?php echo $editFormAction; ?>" name="formMain" id="formMain" method="POST">
<input type="text" id="currLat" name="currLat">
<input type="text" id="currLong" name="currLong">
<input type="submit" id="subToDb" name="subToDb">
<input type="hidden" name="MM_update" value="formMain">
</form>
</div>
<div id="geoAddress">
  


      <input name="address" id="address" type="textbox">
      <input type="button" value="Geocode" onclick="codeAddress()">
   

    

	


    
  </div>
 
</div>

<div id="latitude">
<?php
 $latitude = $row_getLoca['lat'];
 echo htmlspecialchars($latitude);
?>
</div>
<div id="longtitude">
<?php
$longtitude = $row_getLoca['long'];
echo htmlspecialchars($longtitude);
?>
</div>

<p>&nbsp;</p>
</body></html>
<?php
mysql_free_result($getLoca);
?>
