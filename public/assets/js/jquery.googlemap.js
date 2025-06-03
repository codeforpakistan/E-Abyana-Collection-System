
$(function() {
    $("#simple-map").googleMap({
      zoom: 5, // Initial zoom level (optional)
      coords: [37.089462, -95.710452], // Map center (optional)
      type: "ROADMAP" // Map type (optional)
    });
  })
  $(function() {
	$("#map").googleMap({
        lat: -12.043333,
        lng: -77.028333
      });
      map.setContextMenu({
        control: 'map',
        options: [{
          title: 'Add marker',
          name: 'add_marker',
          action: function(e){
            this.addMarker({
              lat: e.latLng.lat(),
              lng: e.latLng.lng(),
              title: 'New marker'
            });
            this.hideContextMenu();
          }
        }, {
          title: 'Center here',
          name: 'center_here',
          action: function(e){
            this.setCenter(e.latLng.lat(), e.latLng.lng());
          }
        }]
      });
})
 $(function() {
    $("#map1").googleMap();
    $("#map1").addMarker({
      coords: [51.507351, -0.127758], // GPS coords
      title: 'Marker nÂ°1', // Title
      text:  '<b>Lorem ipsum</b> dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' // HTML content
    });
  })
  $(function() {
	$("#map2").googleMap({
		zoom: 12,
		lat: 40.65,
		lng: -73.95
	});
  })
  $(function() {
    $("#map3").googleMap();
    
    // Marker 1
    $("#map3").addMarker({
    	 coords: [51.534287, -0.033580]
    });
    
    // Marker 2
    $("#map3").addMarker({
    	 coords: [51.507351, -0.127758]
    });
	
    // Marker 3
    $("#map3").addMarker({
        coords: [37.089462, -95.710452]
    });
  })
    $(function() {
    $("#map4").googleMap({
		zoom: 15, 
		lat: 17.4574683, 
		lng: 78.2822645, 
		click: function (e) { 
			var info = "Click event occured!"; 
			$("#ClickEventDivID").text(info); 
		}, 
		dragend: function (e) { 
			var info = "User dragged a location !"; 
			$("#DragEventDivID").text(info); 
		}, 
	});
   

  })