var map;
var InforObj = [];
var centerCords = {
	lat: 43.2609,
	lng: -79.9192
};
var markersOnMap = [{
		placeName: "BSB B134",
		LatLng: [{
			lat: 43.262041,
			lng: -79.920158
		}]
	}
];

window.onload = function () {
	initMap();
};

function addMarkerInfo() {
	for (var i = 0; i < markersOnMap.length; i++) {
		var contentString = '<div id="content"><h1>' + markersOnMap[i].placeName + '</h1></div>';

		const marker = new google.maps.Marker({
			position: markersOnMap[i].LatLng[0],
			map: map
		});

		const infowindow = new google.maps.InfoWindow({
			content: contentString,
			maxWidth: 200
		});

		marker.addListener('click', function () {
			closeOtherInfo();
			infowindow.open(marker.get('map'), marker);
			InforObj[0] = infowindow;
		});
		// marker.addListener('mouseover', function () {
		//     closeOtherInfo();
		//     infowindow.open(marker.get('map'), marker);
		//     InforObj[0] = infowindow;
		// });
		// marker.addListener('mouseout', function () {
		//     closeOtherInfo();
		//     infowindow.close();
		//     InforObj[0] = infowindow;
		// });
	}
}

function closeOtherInfo() {
	if (InforObj.length > 0) {
		/* detach the info-window from the marker ... undocumented in the API docs */
		InforObj[0].set("marker", null);
		/* and close it */
		InforObj[0].close();
		/* blank the array */
		InforObj.length = 0;
	}
}

function initMap() {
	map = new google.maps.Map(document.getElementById('GoogleMap1'), {
		zoom: 15,
		center: centerCords
	});
	addMarkerInfo();
}