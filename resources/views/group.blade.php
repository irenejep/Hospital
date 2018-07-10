@extends("layouts.master")
<body onload = "generateRefreshToken()">
@section("content")
<!-- <button id='group'class='btn btn-primary btn-sm' type="submit"><b><i><i class="material-icons">verified_user</i>View all groups</i></b></button> -->
    <h3>User authentication</h3>
    <div id  = "allgroups"></div>
    <div id="form">
    <form action="#" name="inputform">
    @csrf
    <input type="hidden" name="applicationId" value={{$application_id}}/>
    <input type="hidden" name="applicationPhone" value="{{$application_phone}}"/>
    <input type="hidden" name="applicationSecret" value="{{$application_secret}}"/>
    
    <div class="inputItems">
        <label>Input pin:</label>
        <input type="text" name="pin" placeholder="input pin"/>
        <button class='btn btn-primary btn-sm' type="submit"><b><i><i class="material-icons">verified_user</i>Verify pin</i></b></button>
    </div>
    <div class="inputButtons">
    <button class='btn btn-success btn-sm ' type="button" onclick='generatePin("{{$application_id}}","{{$application_phone}}","{{$application_secret}}")'><i class="material-icons">lock</i>Generate Pin</button>
    </div>
    <div class="inputButtons">
    </div>
    </form>
    </div>
    <div id="groupForm">
    <form action="POST" name="groupinputform" id = "createGroup">
    @csrf
    <input type="hidden" id="accessToken" value="accessToken"/>
    <div class="inputItems">
        <label>Group Name:</label>
        <input type="text" name="groupName"/>
    </div>
    <div class="inputItems">
        <label>Welcome message:</label>
        <input class= "form-control" class= "form-control" type="text" name="welcomeMessage"/>
    </div>
    <div class="inputItems">
        <label>Group type:</label>
        <input class= "form-control" type="text" name="groupType"/>
    </div>
    <div class="inputButtons">
    <button class='btn btn-primary btn-sm' type="submit"><i class="material-icons">group</i>Create group</button>
    </div>
    </form>
    </div><!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
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
  <body>
    <div id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 6
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=PB2M8cVvLyhca-SQPf9RfQ&callback=initMap">
    </script>
  </body>
</html>
    <script src="/js/kaizala.js"></script>
@endsection
</body>