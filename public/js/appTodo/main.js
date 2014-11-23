require.config({
    'paths': {
        baseUrl: './',
        jquery: 'http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min',
        jqueryui: 'lib/jqueryui.1.11.1',
        "jqueryui.mapster": 'lib/jqueryui.mapster',
        async: "lib/async",
        bootstrap: 'lib/bootstrap',
        backbone: 'lib/backbone',
        underscore: 'lib/underscore',
        datatables: 'lib/jquery.dataTables',
        datatablesntegration: 'lib/dataTables.bootstrap'
    },
    shim: {
    	jqueryui: ['jquery'],
        bootstrap: ['jquery', 'underscore'],
        datatables: ['jquery'],
        datatablesntegration: ['datatables']
    }
});

require(['app'], function(App) {
    window.App = {};
    App.initialize();
});
//
//require(['jquery', 'modules/Mapster','jqueryui.mapster', 'bootstrap', 'datatables', 'datatablesntegration'], function($, mapster, mplugin) {
//    $('h1').text('Require It\'s working!');
//    $mapa = $("#mapa-oferty");
//    var mapCanvas = $mapa? $mapa.get(0):null;
//    $('[data-toggle="tooltip"]').tooltip({
//        placement : 'right'
//    });
//    $(function(){
//        $('#oferta').dataTable();
//    
//        $(".pokazOpis").click(function(e) {
//            e.preventDefault();
//            var siblings = $(this).siblings(), content = $(siblings[0]);
//            $('#myModal .modal-body').html(content.html());
//            $('#myModal').modal('show');
//        });
//    });
//});
//
//
//    var map = mapster.create(mapCanvas);
//    map._on({
//		elem: map.gMap,
//		event: 'rightclick',
//		callback: function() {
//			alert('prawy klik');
//		}
//	});
//    var marker = map.addMarker({
//		lat: 37.791350,
//		lng: -122.435883,
//		draggable: true,
//		icon: "http://mapicons.nicolasmollet.com/wp-content/uploads/mapicons/shape-default/color-ff8a22/shapecolor-color/shadow-1/border-dark/symbolstyle-white/symbolshadowstyle-dark/gradient-no/soccer.png",
//		id: 1,
//		content: "<div class='color'>Im open</div>",
//		events: [{
//			name: 'click',
//			callback: function() {
//				alert('jestem klikniety');
//			}
//		},
//		{
//			name: 'dragend',
//			callback: function() {
//				alert('jestem dragend');
//			}
//		}]
//	});
//        map._geocode('gdańsk, kościuszki');
//    var marker2 = map.addMarker({
//		lat: 37.771350 + Math.random(),
//		lng: -122.565883 + Math.random(),
//		draggable: true,
//		icon: "http://mapicons.nicolasmollet.com/wp-content/uploads/mapicons/shape-default/color-ff8a22/shapecolor-color/shadow-1/border-dark/symbolstyle-white/symbolshadowstyle-dark/gradient-no/soccer.png",
//		id: 2,
//		content: "<div class='color'>Im open</div>",
//		events: [{
//			name: 'click',
//			callback: function(e) {
//				alert('jestem klikniety');
//			}
//		},
//		{
//			name: 'dragend',
//			callback: function(e) {
//				alert('jestem dragend');
//			}
//		}]
//	});
//    for (i=0; i< 40; i++) {
//    	map.addMarker({
//    		lat: 37.771350 + Math.random(),
//    		lng: -122.565883 + Math.random(),
//    		draggable: true,
//    		icon: "http://mapicons.nicolasmollet.com/wp-content/uploads/mapicons/shape-default/color-ff8a22/shapecolor-color/shadow-1/border-dark/symbolstyle-white/symbolshadowstyle-dark/gradient-no/soccer.png",
//    		id: i,
//    		content: "<div class='color'>Im open</div>",
//    		events: [{
//    			name: 'click',
//    			callback: function() {
//    				alert('jestem klikniety nr: ' + i);
//    			}
//    		},
//    		{
//    			name: 'dragend',
//    			callback: function() {
//    				alert('jestem dragend');
//    			}
//    		}]
//    	});
//    }
    // usuwa połowę markerów
//    map.removeBy(function(marker) {
//    	return marker.id % 2;
//    })
//    $("#mapa-oferty").mapster();
