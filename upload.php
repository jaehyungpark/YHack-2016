<!DOCTYPE html>
<html style="width: 100%; height: 100%; padding: 0px; margin: 0px;">
 <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
<Style>
#map {
  position: relative;
}
#map canvas, #overlay {
  position: absolute;
}
canvas {
  border: 1px solid black;
}
</Style>
</head>
<title> Configurations </title>
<body style=" width: 100%; height: 100%; padding: 0px; margin: 0px; overflow: hidden;">

<div id="settings" style="float: left; width: 30%; height: 100%; background-color: rgba(0, 0, 0, 0.8); display: table;">
<div style="padding: 10px; float: middle; display: table-cell;
    vertical-align: middle; color: white">
<form id="dataIN" action="upload.php" method="post" enctype="multipart/form-data">
<fieldset>
    <legend>Analytic Settings:</legend>
	<h4>Country:</h4>
	<input type="text" name="Country" placeholder="USA"> 

	<h4>Computational Area:</h4>
	
	Latitude: <input type="number" name="LatitudeB" placeholder="1"> 
	Longitude: <input type="number" name="LongitudeB" placeholder="1"> 

	<h4>Resoultion:</h4>
	
	Latitude: <input type="number" name="Latitude" placeholder="0.1"> 
	Longitude: <input type="number" name="Longitude" placeholder="0.1"> 
</fieldset>
<br>
<fieldset>
<legend>Upload Data File:</legend>
	<h4>Data</h4>
	<input type="file" name="datafile" id="datafile">
</fieldset>
<br>
	<input type="submit" style="color: black; width: 100%;" value="Upload Configurations" name="submit"></input>
</fieldset>
	  
</form>

</div>
<div style="display: table-cell; vertical-align: middle;">
  <a onclick="hide();" class="btn-floating btn-medium z-depth-1" style="background-color: rgba(0,0,0,0)"><i class="material-icons">menu</i></a>
</div>

</div>

<div id="settings2" style="float: left; height: 100%; background-color: rgba(0, 0, 0, 0.8); display: none;">
<div style="display: table-cell; vertical-align: middle;">
	<a onclick="show();" " class="btn-floating btn-medium z-depth-1" style="background-color: rgba(0,0,0,0)"><i class="material-icons">menu</i></a>
</div>
</div>

 <div id="map" style="width: 70%; height: 100%;">
 	<canvas id="DRAWONME"></canvas>
 </div>
    <script>

	var country = "USA";
	var geocoder;
	var map;

      function initMap() {
        // Create a map object and specify the DOM element for display.
        map = new google.maps.Map(document.getElementById('map'), {
          //center: {lat: -34.397, lng: 150.644},
          scrollwheel: false,
          //zoom: 1
        });



		geocoder = new google.maps.Geocoder();

	

        geocoder.geocode( {'address' : country}, function(results, status) {
    	if (status == google.maps.GeocoderStatus.OK) {
    		for (i=0;i<results.length; i++){
    			console.log(results[i]);
    		}

        	var bounds = new google.maps.LatLngBounds(
        		new google.maps.LatLng(results[0].geometry.bounds.f.f,results[0].geometry.bounds.b.b), 
                 new google.maps.LatLng(results[0].geometry.bounds.f.b,results[0].geometry.bounds.b.f));
        	latRange = results[0].geometry.bounds.f.f-results[0].geometry.bounds.f.b;
        	longRange = results[0].geometry.bounds.b.b - results[0].geometry.bounds.b.f;
        	lat1 = results[0].geometry.bounds.f.f;
        	lat2 = results[0].geometry.bounds.f.b;
        	long1 = results[0].geometry.bounds.b.b;
        	long2 = results[0].geometry.bounds.b.f;
        	console.log(lat1);
        	console.log(lat2);
        	map.fitBounds(bounds);

      buildMap(lat1,lat2,long1,long2,1,1);
   		 }

	});
        } 


  
function hide (){
 	document.getElementById("settings").style.display = "none";
 	document.getElementById("settings2").style.display = "table";
 	var tmp = document.getElementById("map");
 	tmp.style.width = "auto";
 	google.maps.event.trigger(map, "resize");
 }

 function show(){
 	document.getElementById("settings").style.display = "table";
 	document.getElementById("settings2").style.display = "none";
 	var tmp = document.getElementById("map");
 	tmp.style.width = "70%";
	google.maps.event.trigger(map, "resize");

 	
 }

 function buildMap(lat1,lat2,long1,long2,r1,r2){

 	console.log (lat1+"BUILD");
 
	 	// LATITUDES
	tmpL1 = lat1;
 	for (y=0; (lat1+y)<=0;y+=r2){
 		var tmpLine = [{lat: tmpL1+y, lng: long1},  {lat: tmpL1+y, lng: long2}]
 		var flightPath = new google.maps.Polyline({
          path: tmpLine,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);
 	}

 	if (lat1 < 0){
 		tmpL1 = 0;
 	}

 	for (x=0; (tmpL1+y)<=lat2;y+=r2){
 		var tmpLine = [{lat: tmpL1+y, lng: long1},  {lat: tmpL1+y, lng: long2}]
 		var flightPath = new google.maps.Polyline({
          path: tmpLine,
          geodesic: true,
          strokeColor: '#cccccc',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);
 	} 	


 	 // LONGITUDES
 	if (long1 > long2){


 	for (x=0; (long1+x)<=180;x+=r1){
 		var tmpLine = [{lat: lat1, lng: long1+x},  {lat: lat2, lng: long1+x}]
 		var flightPath = new google.maps.Polyline({
          path: tmpLine,
          geodesic: true,
          strokeColor: '#cccccc',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);
 	}

 	for (x=0; (-180+x)<=long2;x+=r1){
 		var tmpLine = [{lat: lat1, lng: -180+x},  {lat: lat2, lng: -180+x}]
 		var flightPath = new google.maps.Polyline({
          path: tmpLine,
          geodesic: true,
          strokeColor: '#cccccc',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);
 	} 	
 	}else{
 		
 	for (x=0; (long1+x)<=long2;x+=r1){
 		var tmpLine = [{lat: lat1, lng: long1+x},  {lat: lat2, lng: long1+x}]
 		var flightPath = new google.maps.Polyline({
          path: tmpLine,
          geodesic: true,
          strokeColor: '#cccccc',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);
 	}

 	}
 }


var form = document.getElementById('dataIN');
if (form.attachEvent) {
    form.attachEvent("submit", validateFormOnSubmit);
} else {
    form.addEventListener("submit", validateFormOnSubmit);
}
 
 function validateFormOnSubmit(theForm) {
 	
        
}

function rebuildMap(country_,r1_,r2_){
  country = country_;
  var geocoder;
  var map;

      
        // Create a map object and specify the DOM element for display.
        map = new google.maps.Map(document.getElementById('map'), {
          //center: {lat: -34.397, lng: 150.644},
          scrollwheel: false,
          //zoom: 1
        });



    geocoder = new google.maps.Geocoder();

  

        geocoder.geocode( {'address' : country}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        for (i=0;i<results.length; i++){
          console.log(results[i]);
        }

          var bounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(results[0].geometry.bounds.f.f,results[0].geometry.bounds.b.b), 
                 new google.maps.LatLng(results[0].geometry.bounds.f.b,results[0].geometry.bounds.b.f));
          latRange = results[0].geometry.bounds.f.f-results[0].geometry.bounds.f.b;
          longRange = results[0].geometry.bounds.b.b - results[0].geometry.bounds.b.f;
          lat1 = results[0].geometry.bounds.f.f;
          lat2 = results[0].geometry.bounds.f.b;
          long1 = results[0].geometry.bounds.b.b;
          long2 = results[0].geometry.bounds.b.f;
          console.log(lat1);
          console.log(lat2);
          map.fitBounds(bounds);

      buildMap(lat1,lat2,long1,long2,r1_,r2_);
       }


  });

}

function test(a,b,c){
console.log(a);
console.log(b);
console.log(c);
}
var form = document.getElementById('dataIN');
if (form.attachEvent) {
    form.attachEvent("CUSTOMTING", validateFormOnSubmit);
} else {
    form.addEventListener("CUSTOMTING", validateFormOnSubmit);
} 
 </script>
 <script
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZPU8Y-fNmssM88HOHSbf06SlyIOZOQUk&callback=initMap"
    async defer></script>

    <?php

   $tmp1 = $_REQUEST['Country'];
  $tmp2 = $_REQUEST['LatitudeB'];
   $tmp3 = $_REQUEST['LongitudeB'];
   echo "<h1>|"+$_REQUEST['Latitude']+"</h1>";
   echo "<h1>|"+$_REQUEST['Longitude']+"</h1>";
  $tmp4 = '<script type="text/javascript">
     rebuildMap("' . $tmp1 . '",' . $tmp2 . ',' . $tmp3 . ');
     </script>'  ;
  echo $tmp4;

if(isset($_FILES['datafile'])){
      $errors= array();
      $file_name = $_FILES['datafile']['name'];
      $file_size =$_FILES['datafile']['size'];
      $file_tmp =$_FILES['datafile']['tmp_name'];
      $file_type=$_FILES['datafile']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['datafile']['name'])));
      
      
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      //works find left out for demo purposes
      if(empty($errors)==true){
        // move_uploaded_file($file_tmp, __DIR__ . "/Data/DataIn.csv");
       
         echo "Success";
      }else{
         print_r($errors);
      }
       
   }




   ?>
    
</body>
</html>