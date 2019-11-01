//runs the map on the search results page

//map object
var map;
//list of marker info tags
var markerInfo = [];
//coordinates to center the map at
var centerCoords = {
	lat: 43.2609,
	lng: -79.9192
};
//list of coordinates of search results
var markers = [{
		placeName: "BSB B134",
		LatLng: [{
			lat: 43.262041,
			lng: -79.920158
		}]
	},
	{
		placeName: "ITB 123",
		LatLng: [{
			lat: 43.258917,
			lng: -79.920859
		}]
	},
	{
		placeName: "MDCL 1101",
		LatLng: [{
			lat: 43.261183,
			lng: -79.916812
		}]
	}
];

//when the page loads, initialize the map
window.onload = function () {
	initMap();
};

//add the info tags for each marker
function addMarkerInfo() {
	for (var i = 0; i < markers.length; i++) {
		var contentString = '<div id="content"><h2>' + markers[i].placeName + '</h2></div>';

		const marker = new google.maps.Marker({
			position: markers[i].LatLng[0],
			map: map
		});

		const infowindow = new google.maps.InfoWindow({
			content: contentString,
			maxWidth: 200
		});

		marker.addListener('click', function () {
			closeOtherInfo();
			infowindow.open(marker.get('map'), marker);
			markerInfo[0] = infowindow;
		});
	}
}

//close all other tags
function closeOtherInfo() {
	if (markerInfo.length > 0) {
		markerInfo[0].set("marker", null);
		markerInfo[0].close();
		markerInfo.length = 0;
	}
}

//initialize the map
function initMap() {
	map = new google.maps.Map(document.getElementById('GoogleMap1'), {
		zoom: 15,
		center: centerCoords
	});
	addMarkerInfo();
}