function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    window.alert("Unable to get position.")
  }
}

function showPosition(position) {
  window.alert("Latitude: " + position.coords.latitude + "\nLongitude: " + position.coords.longitude);
}