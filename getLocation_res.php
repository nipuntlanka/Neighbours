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
$query_getLoca = "SELECT * FROM users WHERE users.Email='akila@gmail.com'";
$getLoca = mysql_query($query_getLoca, $My_Con) or die(mysql_error());
$row_getLoca = mysql_fetch_assoc($getLoca);
$totalRows_getLoca = mysql_num_rows($getLoca);mysql_select_db($database_My_Con, $My_Con);
$query_getLoca = "SELECT userlocation.lat, userlocation.`long`   FROM users, userlocation WHERE users.Email='akila@gmail.com'";
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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>

<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="css/getLocation.css" rel="stylesheet" type="text/css">
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

function codeAddress() {
  var address = document.getElementById('address').value;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
	  map.setZoom(15);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}









    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(7.149154610187877,80.0600144412083),
        zoom: 15,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;
	  
	  
	  
	  
	  /********************draggable circle definition on map-canvas****************/
	  
			   var circleOptions = {
			  strokeColor: '#FF0000',
			  strokeOpacity: 0.8,
			  strokeWeight: 2,
			  fillColor: '#FF0000',
			  fillOpacity: 0.28,
			  zIndex: 10,
			  map: map,
			  center: new google.maps.LatLng(7.149154610187877,80.0600144412083),
			  radius: 200,
			  editable: false,
			  draggable: true,
			
			  
			};
			
			
			// Add the circle for this city to the map.
			cityCircle = new google.maps.Circle(circleOptions);	
			cityCircle.setMap(map);
			
				var locDetails1 = 'Center: '+ cityCircle.getCenter().toString();//+ '\n Bounds'+cityCircle.getBounds();
				var locDetails2 = 'Radius: '+ cityCircle.getRadius();
				//document.getElementById("center_detail").value = locDetails1;
				//document.getElementById("bound_detail").value = locDetails2;
				
				//dynamic main marker define
				var dy_marker = new google.maps.Marker({
				map: map,
				position:  cityCircle.getCenter(),
				draggable:true,
				zIndex:11,
				
				
				
				
			  });
			  cityCircle.bindTo('center', dy_marker, 'position');
			  bindMainInfoWindow(dy_marker, map, infoWindow, adminLoc);
			 
		  
		
		  
		  
	
	  
	  /****************************************************************************************************/
	  
	}

</script>
<style type="text/css">
   html,body{
	   width:100%;
	   padding:2px;
	   }
   #map {
        height: 80%;
		width: 75%;
        margin-left:1%;
        padding: 0px;
		border:solid;
		border-width:1px;
      }
	</style>
</head><body onload="load()">
<div class="gridContainer clearfix">
  <div id="header">
    <h1>Set Your Location</h1>
  </div>
  <div id="map"></div>
  <div id="geoAddress">
    <input id="address" type="textbox" value="">
    <input type="button" value="Geocode" onclick="codeAddress()">
    
    <script></script>
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
</body></html>
<?php
mysql_free_result($getLoca);
?>
