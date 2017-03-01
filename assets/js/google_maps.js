function initMap  () {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        scrollwheel: false,
        mapTypeId: 'roadmap',
		mapTypeControl: false
    };

    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    map.setTilt(45);

    // Multiple Markers
    var markers = [
        ['Dot Baires Shopping', -34.545737,-58.4905297],
        ['Gurruchaga 691, Palermo', -34.595769,-58.4415002],
		['Calle 2, 855, Sta Teresita', -36.538730, -56.689746],
		['Chioza 2440, San Bernardo', -36.690711, -56.677841],
    ];

    // Info Window Content
    var infoWindowContent = [
        ['<div class="info_content">' +
        '<h3>Dot Baires Shopping</h3>' +
        '<p></p>' + '</div>'],
        ['<div class="info_content">' +
        '<h3>Gurruchaga 691, Palermo</h3>' +
        '<p></p>' + '</div>'],
        ['<div class="info_content">' +
        '<h3>Calle 2, número 855, Santa Teresita</h3>' +
        '<p></p>' + '</div>'],
        ['<div class="info_content">' +
        '<h3>Av. Chiozza 2440, San Bernardo</h3>' +
        '<p></p>' + '</div>']
    ];

    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    // Loop through our array of markers & place each one on the map
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });

        // Allow each marker to have an info window
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(7);
        google.maps.event.removeListener(boundsListener);
    });

	google.maps.event.addDomListener(document.getElementById('dot'), 'click', function() {
		map.setCenter({ lat: -34.545737, lng: -58.4905297})
		map.setZoom(14);
	});
	
	google.maps.event.addDomListener(document.getElementById('gurruchaga'), 'click', function() {
		map.setCenter({ lat: -34.595769, lng: -58.4415002})
		map.setZoom(14);
	});
	
	google.maps.event.addDomListener(document.getElementById('teresita'), 'click', function() {
		map.setCenter({ lat: -36.538730, lng: -56.689746})
		map.setZoom(15);
	});

	google.maps.event.addDomListener(document.getElementById('bernardo'), 'click', function() {
		map.setCenter({ lat: -36.690711, lng: -56.677841})
		map.setZoom(15);
	});

}
