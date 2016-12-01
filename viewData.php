<!DOCTYPE html>
<html>
  <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>ANALYZED</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body style="overflow: hidden;">
    <div id="map"></div>
    <script>
      // This example creates circles on the map, representing populations in North
      // America.
      $.ajax({  
    type: "POST",  
    url: "download.php?q=getData",  
    data: { 'Score':72 },      
    success: function(data){ // <-- note the parameter here, not in your code
      console.log(data);
      
       process(data.split("\n"));
    } 
    });

      var citymap = {
        
      };

      function process(dataIn){

      map = new google.maps.Map(document.getElementById('map'), {
          zoom: 2,
          center: {lat: 0, lng: 0},
          mapTypeId: 'terrain',
          scrollwheel: false,
          draggable: false,
          disableDefaultUI: true
        });

        for ( i=1; i< dataIn.length; i++){
        tmpData = dataIn[i].split(",");
        longi = (parseInt(tmpData[1])-180);
        latti = (parseInt(tmpData[0])-180);
          tmp = {
          center: {lat: latti, lng: longi},
          population: (parseInt(tmpData[3])*1000000)
        }
          var cityCircle = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            map: map,
            center: {lat: latti, lng: longi},
            radius: Math.sqrt(100000) * 100
          });
        
        }
      }

      function initMap() {
        // Create the map.
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 1,
          disableDefaultUI: true,
          scrollwheel: false,
          mapTypeId: 'terrain'
        });
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZPU8Y-fNmssM88HOHSbf06SlyIOZOQUk&callback=initMap">
    </script>
  </body>
</html>