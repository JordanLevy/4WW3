dest = "";

function getLocation(d) {
	dest = d;
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, positionError);
  } else {
    alert("Unable to search using location.")
  }
}

function showPosition(position) {
  alert("Searching for McMaster restrooms near coordinates:\nLatitude: " + position.coords.latitude +
  "\nLongitude: " + position.coords.longitude);
  window.location.href=dest;
}

function positionError() {
	alert("Unable to search using location. Please allow the site to know your location, or try to search by criteria instead.");
}