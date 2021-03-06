<!DOCTYPE html>
<html>
<head>
    <title>Place searches</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        html, body {
            height: 600px;
            width: 500px;
            margin: 0;
            padding: 0;
        }

        #map {
            height: 100%;
        }
    </style>
    <script>
        var map;
        var infowindow;
        function initMap() {
            var pyrmont = {lat: 41.1946362, lng: -8.6436875};

            map = new google.maps.Map(document.getElementById('map'), {
                center: pyrmont,
                zoom: 15
            });

            infowindow = new google.maps.InfoWindow();

            var service = new google.maps.places.PlacesService(map);
            service.nearbySearch({
                location: pyrmont,
                radius: 500,
                types: ['restaurant']
            }, callback);
        }

        function callback(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
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

            google.maps.event.addListener(marker, 'click', function () {
                infowindow.setContent(place.name);
                infowindow.open(map, this);
            });
        }

    </script>
</head>
<body>
<div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcb4IphCwicIMVCal_rr12SMuUijYYveE&signed_in=true&libraries=places&callback=initMap"
        async defer></script>
</body>
</html>