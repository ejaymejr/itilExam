<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
?>
<?php include_once 'lib/_headerFile.php'; ?>
<?php include_once 'lib/_navigationBar.php'; ?>
<?php include_once 'lib/_connection.php'; ?>
<?php include_once 'lib/HTMLLib.php'; ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>

<script>


  function initialize() {

	  var markers = [];
	  var map = new google.maps.Map(document.getElementById('map-canvas'), {
		    zoom: 12,
		    center: {lat: 1.352083, lng: 103.819836}
		  });
	  
// 	  var defaultBounds = new google.maps.LatLngBounds(
// 	      new google.maps.LatLng(1.3, 103.8),
// 	      new google.maps.LatLng(1.3, 103.8));
// 	  map.fitBounds(defaultBounds);

	  // Create the search box and link it to the UI element.
	  var input = /** @type {HTMLInputElement} */(
	      document.getElementById('pac-input'));
	  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

	  var searchBox = new google.maps.places.SearchBox(
	    /** @type {HTMLInputElement} */(input));

	  // Listen for the event fired when the user selects an item from the
	  // pick list. Retrieve the matching places for that item.
	  google.maps.event.addListener(searchBox, 'places_changed', function() {
	    var places = searchBox.getPlaces();

	    if (places.length == 0) {
	      return;
	    }
	    for (var i = 0, marker; marker = markers[i]; i++) {
	      marker.setMap(null);
	    }

	    // For each place, get the icon, place name, and location.
	    markers = [];
	    var bounds = new google.maps.LatLngBounds();
	    for (var i = 0, place; place = places[i]; i++) {
	      var image = {
	        url: place.icon,
	        size: new google.maps.Size(1000, 1000),
	        origin: new google.maps.Point(0, 0),
	        anchor: new google.maps.Point(17, 34),
	        scaledSize: new google.maps.Size(25, 25)
	      };

	      // Create a marker for each place.
	      var marker = new google.maps.Marker({
	        map: map,
	        icon: image,
	        title: place.name,
	        position: place.geometry.location
	      });

	      markers.push(marker);

	      bounds.extend(place.geometry.location);
	    }

// 	    map.fitBounds(bounds);

	  });
	  
	  var request = {
			    location: pyrmont,
			    radius: 500,
			    types: ['store']
			  };
			  infowindow = new google.maps.InfoWindow();
			  var service = new google.maps.places.PlacesService(map);
			  service.nearbySearch(request, callback);
	  
	  // Bias the SearchBox results towards places that are within the bounds of the
	  // current map's viewport.
	  google.maps.event.addListener(map, 'bounds_changed', function() {
	    var bounds = map.getBounds();
	    searchBox.setBounds(bounds);
	  });
	}

  function callback(results, status) {
	  if (status == google.maps.places.PlacesServiceStatus.OK) {
	    for (var i = 0; i < results.length; i++) {
	      createMarker(results[i]);
	    }
	  }
	}

	function createMarker(place) {
	  var placeLoc = place.geometry.location;
	  var marker = new google.maps.Marker({
	    map: map,
	    position: place.geometry.location
	  });

	  google.maps.event.addListener(marker, 'click', function() {
	    infowindow.setContent(place.name);
	    infowindow.open(map, this);
	  });
	}
	
		

	google.maps.event.addDomListener(window, 'load', initialize);</script>
  </head>
  <body class="metro">
  	<input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map-canvas"></div>
  </body>

