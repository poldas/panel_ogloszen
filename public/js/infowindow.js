var myCustomMaps = (function (jQuery) {
    var instance,
        map,
        mapCanvas = jQuery('#map_canvas')[0],
        init = function () {
            return {
                pageLoad: function () {
                    this.invokeMyMaps();
                },
                invokeMyMaps: function() {

                    var	markers = [], infoBubbles = [], infoBubble,
                        contentString=['<div id="tabs">','<ul>','<li><a href="#tab-1"><span>Tab1</span></a></li>','<li><a href="#tab-2"><span>Tab2</span></a></li>','<li><a href="#tab-3"><span>Tab3</span></a></li>','</ul>','<div id="tab-1">','<p>Tab 1 content. You can customize it further and make this dynamic / JS Object</p>','</div>','<div id="tab-2">','<p>Tab 2 content</p>','</div>','<div id="tab-3">','<p>Tab 3 content</p>','</div>','</div>'].join('');

                    map = new google.maps.Map(mapCanvas, {
                        zoom: 10,
                        center: new google.maps.LatLng(-33.950198, 151.259302),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    jQuery.ajax({
                        url: 'Beach.json',
                        type: 'GET',
                        dataType: 'json',
                        success: function(D) {

                            beachSpecs = D.beaches;
                            jQuery.each(beachSpecs, function(k, v) {
                                //console.log(v.beachName, v.latitude, v.longitude);

                                // Creating / Initiating Markers:
                                var marker = new google.maps.Marker({
                                    position: new google.maps.LatLng(v.latitude, v.longitude),
                                    map: map,
                                    title: jQuery.trim(v.beachName)
                                });

                                // Creating / Initiating Infobox
                                infoBubble = new InfoBox({
                                    content: contentString, // Tab content gets appended here.
                                    disableAutoPan: false,
                                    maxWidth: 0,
                                    pixelOffset: new google.maps.Size(-140, 0),
                                    zIndex: null,
                                    boxStyle: {
                                        //background: "url('tipbox.gif') no-repeat",
                                        opacity: 1,
                                        width: "280px"
                                    },
                                    closeBoxMargin: "0px",
                                    closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
                                    infoBoxClearance: new google.maps.Size(1, 1),
                                    isHidden: false,
                                    pane: "floatPane",
                                    enableEventPropagation: true
                                });

                                markers[k] = marker;
                                infoBubbles[k] = infoBubble;

                                // Binding Tab Functionality to infowindow
                                google.maps.event.addListener(infoBubble, 'domready', function() {
                                    jQuery("#tabs").tabs();
                                });

                                // Marker Mouse events
                                google.maps.event.addListener(marker, 'mouseup', function() {
                                    $.each(infoBubbles, function(ix, vx) {
                                        if(ix > 0) {
                                            infoBubbles[ix].close();
                                        }
                                    });
                                    infoBubble.open(map, marker);
                                });

                            });

                        }, // success
                        error: function (xhr, textStatus, errorThrown) {
                            alert("Error: " + (errorThrown ? errorThrown : xhr.status));
                        } // error
                    }); //ajax

                } //invokeMyMaps
            };
        };
    return {
        load: function () {
            if (!instance) {
                instance = init();
            }
            return instance;
        }
    };
})(jQuery);

(function (jQuery) {
    var myMaps = myCustomMaps.load();
    myMaps.pageLoad();
})(jQuery);