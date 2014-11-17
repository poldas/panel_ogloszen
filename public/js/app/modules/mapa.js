define(['jquery','http://maps.google.com/maps/api/js?key=YOUR_KEY&sensor=true!callback'], function($){
	function addMap(mapCanvas) {
		var options = {
				center: new google.maps.LatLng( -34.397, 150.644 ),
				zoom: 10,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
		var map = new google.maps.Map( mapCanvas, myOptions );
	}
	return {
		addMap: addMap
	};
});
