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
$query_getCurrGrps = "SELECT * FROM groups WHERE grp_Id != 1";
$getCurrGrps = mysql_query($query_getCurrGrps, $My_Con) or die(mysql_error());
$row_getCurrGrps = mysql_fetch_assoc($getCurrGrps);
$totalRows_getCurrGrps = mysql_num_rows($getCurrGrps);mysql_select_db($database_My_Con, $My_Con);
$query_getCurrGrps = "SELECT * FROM groups WHERE grp_id != 1";
$getCurrGrps = mysql_query($query_getCurrGrps, $My_Con) or die(mysql_error());
$row_getCurrGrps = mysql_fetch_assoc($getCurrGrps);
$totalRows_getCurrGrps = mysql_num_rows($getCurrGrps);
$query_getCurrGrps = "SELECT * FROM groups WHERE grp_id != 1";
$getCurrGrps = mysql_query($query_getCurrGrps, $My_Con) or die(mysql_error());
$row_getCurrGrps = mysql_fetch_assoc($getCurrGrps);
$totalRows_getCurrGrps = mysql_num_rows($getCurrGrps);
?>

<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>PHP/MySQL & Google Maps Example</title>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
    <script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
      }
    };

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
			  fillColor: '#B3D1FF',
			  fillOpacity: 0.35,
			  zIndex: 10,
			  map: map,
			  center: new google.maps.LatLng(7.149154610187877,80.0600144412083),
			  radius: 200,
			  editable: true,
			  draggable: true,
			
			  
			};
			
			
			// Add the circle for this city to the map.
			cityCircle = new google.maps.Circle(circleOptions);	
			cityCircle.setMap(map);
			
				var locDetails1 = 'Center: '+ cityCircle.getCenter().toString();//+ '\n Bounds'+cityCircle.getBounds();
				var locDetails2 = 'Radius: '+ cityCircle.getRadius();
				document.getElementById("center_detail").value = locDetails1;
				document.getElementById("bound_detail").value = locDetails2;
				
				//dynamic main marker define
				var dy_marker = new google.maps.Marker({
				map: map,
				position:  cityCircle.getCenter(),
				draggable:true,
				zIndex:11,
				animation: google.maps.Animation.BOUNCE,
				
				
				
			  });
			  cityCircle.bindTo('center', dy_marker, 'position');
			  bindMainInfoWindow(dy_marker, map, infoWindow, adminLoc);
			 
		  
		
		  // Add an event listener on the cityCircle.
		  google.maps.event.addListener(cityCircle, 'dragend', function(e){
			 
			 	
				var locDetails1 = 'Center: '+ this.getCenter().toString();//+ '\n Bounds'+cityCircle.getBounds();
				var locDetails2 = 'Radius: '+ this.getRadius();
				document.getElementById("center_detail").value = locDetails1;
				document.getElementById("bound_detail").value = locDetails2;
				
			
				//event.stopPropagation();
			  
		  });
		    // Add an event listener on the dy_marker.
		  google.maps.event.addListener(dy_marker, 'dragend', function(e){
			 
			 	
				var locDetails1 = 'Center: '+ cityCircle.getCenter().toString();//+ '\n Bounds'+cityCircle.getBounds();
				var locDetails2 = 'Radius: '+ cityCircle.getRadius();
				document.getElementById("center_detail").value = locDetails1;
				document.getElementById("bound_detail").value = locDetails2;
				
			
				//event.stopPropagation();
			  
		  });
		  
		  
		   google.maps.event.addListener(cityCircle, 'radius_changed', function(e){
			 
				var locDetails1 = 'Center: '+ this.getCenter().toString();//+ '\n Bounds'+cityCircle.getBounds();
				var locDetails2 = 'Radius: '+ this.getRadius();
				if(this.getRadius() > 500){
					
					alert (locDetails2 + " must not exceeds 500m!!!");
					document.getElementById("center_detail").value = locDetails1;
					
					bound_detail.style.color = "red";
					document.getElementById("bound_detail").value = "Out of Bound";
					this.setRadius(500);
					
					}else{
						
						bound_detail.style.color = "green";
					
						document.getElementById("center_detail").value = locDetails1;
						document.getElementById("bound_detail").value = locDetails2;
					}
				
				//event.stopPropagation();
			  
		  });
	  
	  /****************************************************************************************************/
	  

      // Change this depending on the name of your PHP file
      downloadUrl("getUserLocation.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("grp_name");
          var grp_radius = parseFloat(markers[i].getAttribute("grp_radius"));
          var grp_id = markers[i].getAttribute("grp_id");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("long")));
          var html = "<b>" + name + "</b> <br/>" + grp_radius + "m Radius";
          //var icon = customIcons[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            //icon: icon.icon
          });
          bindInfoWindow(marker, map, infoWindow, html);
		  
		  
		   /*current grps circle displaying */
	
	  
	  var current_CircOptions = {
		  strokeColor: '#4679D5',
		  strokeOpacity: 0.8,
		  strokeWeight: 1,
		  fillColor: '#4679D5',
		  fillOpacity: 0.35,
		  map: map,
		  center: point,
		  radius: grp_radius,
	   
    	};
		
		// Add the circle for this city to the map.
		var otherGrp = new google.maps.Circle(current_CircOptions);	
	
		otherGrp.setMap(map);
		  /*********************************/
		  
		  
        }
      });
	  
	 
	  
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'mouseover', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }
	 /**/
	var adminLoc="<b>Your Current Location</b></br><i>drag and mark your group area</i>";
			  
		 function bindMainInfoWindow(dy_marker, map, infoWindow, adminLoc) {
			 google.maps.event.addListener(dy_marker, 'mouseover', function() {
			infoWindow.setContent(adminLoc);
			infoWindow.open(map, dy_marker);
		 });
		 
		 google.maps.event.addListener(dy_marker, 'mouseout', function() {
			 infoWindow.close(map, dy_marker);
		 });
	 }
			  /**/

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

    //]]>

  </script>

  <style type="text/css">
   html, body, #map {
        height: 95%;
		width: 90%;
        margin-left:1%;
        padding: 0px
      }
  #loc_details {
	 width:100%;
	 margin-top: 10px;
	 margin-left:1%;
	  
}
  #currGrps {
	  	position: absolute;
	height: auto;
	width: 20%;
	left: 77%;
}
  </style>
  </head>

  <body onload="load()">
  
  <div class="currGrps" id="currGrps">
  <h2>List of Suggested Groups</h2>
  <form action="" method="post" name="sujGrpSubmit" id="sujGrpSub">
  <select name="sujestedGrps" id="sujGrps">
    <?php
do {  
?>
    <option value="<?php echo $row_getCurrGrps['grp_name']?>"<?php if (!(strcmp($row_getCurrGrps['grp_name'], $row_getCurrGrps['grp_name']))) {echo "selected=\"selected\"";} ?>><?php echo $row_getCurrGrps['grp_name']?></option>
    <?php
} while ($row_getCurrGrps = mysql_fetch_assoc($getCurrGrps));
  $rows = mysql_num_rows($getCurrGrps);
  if($rows > 0) {
      mysql_data_seek($getCurrGrps, 0);
	  $row_getCurrGrps = mysql_fetch_assoc($getCurrGrps);
  }
?>
  </select>
  <input name="Next Step" type="submit" id="subGrp" value="Next">
  </form>
  </div>
    <div id="map"></div>
     <div id="loc_details">
	<form method="" target="">
		<input type="text" id="center_detail" size="60"/>
		<input type="text" id="bound_detail"/>
  </div>
  </body>

</html>  <?php
mysql_free_result($getCurrGrps);
?>