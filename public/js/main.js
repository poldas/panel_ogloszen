jQuery(document).ready(function() {
    var markers = [];
    var map = null;
    var directionsService;
    var elevationService;
    var geocoderService;
    var MAP_NAME = 'mapa-oferty';
    var marker, i;
    var $ = jQuery;
    //function addCustomMarkers(){
    //var locations = [
    //      ['Bondi Beach', -33.890542, 151.274856, 4],
    //      ['Coogee Beach', -33.923036, 151.259052, 5],
    //      ['Cronulla Beach', -34.028249, 151.157507, 3],
    //      ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
    //      ['Maroubra Beach', -33.950198, 151.259302, 1]
    //    ];
    //    for (i = 0; i < locations.length; i++) {
    //      marker = new google.maps.Marker({
    //        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
    //        map: map,
    //        title: "marker"
    //      });
    //
    //      google.maps.event.addListener(marker, 'click', (function(marker, i) {
    //        return function() {
    //          infowindow.setContent(locations[i][0]);
    //          infowindow.open(map, marker);
    //        };
    //      })(marker, i));
    //    }
    //}

    // Geocode an address and add a marker for the result
    function addAddress(_address) {
      var address = _address || document.getElementById('adres').value;
      geocoderService.geocode({ 'address': address }, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
          var latlng = results[0].geometry.location;
          addMarker(latlng, address);
          fitMarkers(results);
        } else if (status === google.maps.GeocoderStatus.ZERO_RESULTS) {
          alert("Address not found");
        } else {
          alert("Address lookup failed");
        }
      });
    }

    // reverse geocoding z współrzędnych adres
    function codeLatLng(latLng, marker) {
        var latlng = latLng || new google.maps.LatLng(54.3165, 21.0134);
        geocoderService.geocode({'latLng': latlng}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                if (marker) {
                    marker.setMap(null);
                    addMarker(latlng, results[0].formatted_address);
                } else if (results[0]) {
                    addMarker(latlng, results[0].formatted_address);
                    fitMarkers(results);
                }
            } else {
              alert("Geocoder failed due to: " + status);
            }
        });
    }

    // Add a marker and trigger recalculation of the path and elevation
    function addMarker(latlng, content) {
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            animation: google.maps.Animation.DROP,
            draggable: true
        });
        var boxText = document.createElement("div");
            //zawartość dymka
            boxText.innerHTML ='<div id="info-window" class="infoBox infobox-wrapper"><h2>'
                    + content + '</h2><div class="infobox-content">'+content+'</div></div>';

        var myOptions = {
            content: boxText,
            disableAutoPan: false,
            maxWidth: 0,
            pixelOffset: new google.maps.Size(-130, -170),
            boxStyle: {
                background: "#ffffff",
                opacity: 1,
                width: "257px",
                height: "160px"
            },
            closeBoxMargin: "-7px -7px 0 0",
            closeBoxURL: "/img/close.png",
            infoBoxClearance: new google.maps.Size(1, 1),
            isHidden: false,
            pane: "floatPane",
            enableEventPropagation: true
        };
    //
    //    var infowindow = new google.maps.InfoWindow({
    //        content: boxText,
    //        boxStyle: {
    //        background: "url('img/tooltip.png') no-repeat",
    //        opacity: 1,
    //        closeBoxURL: "img/close.png",
    //        width: "257px",
    //        height: "160px"
    //       }
    //    });

        var infowindow = new InfoBox(myOptions);
        google.maps.event.addListener(marker, 'click',(function(marker, map) {
                return function() {
                    infowindow.open(map, marker);
                }
            })(marker, map)
        );
        google.maps.event.addListener(marker, 'rightclick', function(e) {
             marker.setMap(null);
        });
         google.maps.event.addListener(marker, 'drag', function(e) {
             infowindow.open(map, marker);
        });
        //infowindow.open(map, marker);

        markers.push(marker);
    }

    // dopasowuje markery do widoku na mapie
    function fitMarkers(result) {
        if (!result) return;
        if (markers.length > 1) {
            var bounds = new google.maps.LatLngBounds();
            for (var i in markers) {
              bounds.extend(markers[i].getPosition());
            }
            map.fitBounds(bounds);
        } else {
            map.fitBounds(result[0].geometry.viewport);
        }
    }

    // INICJALIZACJA skryptu
    function init() {
        geocoderService = new google.maps.Geocoder();
        elevationService = new google.maps.ElevationService();
        directionsService = new google.maps.DirectionsService();

        var myLatlng = new google.maps.LatLng(54.3165, 21.0134);
        var myOptions = {
            zoom: 9,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROAD
        };

//        map = new google.maps.Map(document.getElementById(MAP_NAME), myOptions);

        google.maps.event.addListener(map, 'click', function(event) {
            codeLatLng(event.latLng);
        });
        
        addAddress(document.getElementById('adres').innerHtml);

    }
init();



    //function initialize() {
    //    var loc, map, marker, infobox;
    //
    //    loc = new google.maps.LatLng(-33.890542, 151.274856);
    //
    //    map = new google.maps.Map(document.getElementById("map"), {
    //         zoom: 12,
    //         center: loc,
    //         mapTypeId: google.maps.MapTypeId.ROADMAP
    //    });
    //
    //    marker = new google.maps.Marker({
    //        map: map,
    //        position: loc,
    //        visible: true
    //    });
    //
    //    infobox = new InfoBox({
    //         content: document.getElementById("myInfobox"),
    //         disableAutoPan: false,
    //         pixelOffset: new google.maps.Size(-65, -140),
    //         boxStyle: {
    //            width: "100px"
    //        },
    //        closeBoxMargin: "0px -10px 0 0",
    //            closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
    //        infoBoxClearance: new google.maps.Size(1, 1)
    //    });
    //
    //    google.maps.event.addListener(marker, 'click', function() {
    //        infobox.open(map, this);
    //        map.panTo(loc);
    //        //Give it a little time to set up the infobox.  This time may need to be increased, especially for mobile devices.
    //        setTimeout(function() {
    //            document.getElementById("theBubble").className = "";
    //        }, 75);
    //    });
    //
    //    google.maps.event.addListener(infobox, 'closeclick', function(e) {
    //        document.getElementById("theBubble").className = "hidden";
    //    });
    //}

//    //mapa
//    $(document).ready(function() {
//        return;
//        var lat = 52.229676, lon = 21.012229, rozmiar = new google.maps.Size(33,40), punkt_startowy = new google.maps.Point(0,0), punkt_zaczepienia = new google.maps.Point(16,16);
//        var mapOptions = {
//            center: new google.maps.LatLng(lat, lon),
//            zoom: 4,
//            mapTypeId: google.maps.MapTypeId.ROADMAP
//        };
//        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
//        var marker = new google.maps.Marker({
//            position: new google.maps.LatLng(lat, lon),
//        });
//        // To add the marker to the map, call setMap();
//        marker.setMap(map);
//
//        google.maps.event.addListener(marker,"click",function()
//        {
//            var boxText = document.createElement("div");
//            boxText.style.cssText = "margin-top: 5px; padding: 5px;text-align: center;";
//            boxText.innerHTML = '<div style="height:30px;margin-left: 7px;width: 230px;font-size: 12px; font-weight:bold;">City Hall, Sechelt - British Columbia</div><img style="width:130px;" src="img/photo.jpg">';
//
//            var myOptions = {
//                     content: boxText
//                    ,disableAutoPan: false
//                    ,maxWidth: 0
//                    ,pixelOffset: new google.maps.Size(-130, -170)
//                    ,zIndex: null
//                    ,boxStyle: {
//                      background: "url('img/tooltip.png') no-repeat"
//                      ,opacity: 1
//                      ,width: "257px"
//                      ,height: "160px"
//                     }
//                    ,closeBoxMargin: "-7px -7px 0 0"
//                    ,closeBoxURL: "img/close.png"
//                    ,infoBoxClearance: new google.maps.Size(1, 1)
//                    ,isHidden: false
//                    ,pane: "floatPane"
//                    ,enableEventPropagation: false
//            };
//
//            var ib = new InfoBox(myOptions);
//            ib.open(map, marker);
//        });
//    });
});