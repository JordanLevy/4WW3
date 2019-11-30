//handles geolocation

//gets the longitude and latitude of the device
function getLocation(d) {
	if (navigator.geolocation) {
		if(d == 'None') {
			navigator.geolocation.getCurrentPosition(setLatLongCoords, currLocError);
		}
		else {
			navigator.geolocation.getCurrentPosition(showPosition, searchError);
		}
	} else {
		alert("Unable to search using location.")
	}
}

//display the location and redirect to dest
function showPosition(position) {
	document.getElementById('searchLatitude').value = position.coords.latitude
	document.getElementById('searchLongitude').value = position.coords.longitude;
}

//sets the latitude and longitude text boxes
function setLatLongCoords(position) {
	document.getElementById('latitude').value = position.coords.latitude
	document.getElementById('longitude').value = position.coords.longitude;
}

//show an error on the search page
function searchError() {
	alert("Unable to search using location. Please allow the site to know your location, or try to search by criteria instead.");
}

//show an error on the submission page
function currLocError() {
	alert("Unable to retrieve current location. Please allow the site to know your location, or enter your coordinates manually instead.")
}