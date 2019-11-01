//handles uploading an image on the object submission  page

window.addEventListener('load', function() {
	//if the "Upload an Image" button has been clicked"
	document.querySelector('input[type="file"]').addEventListener('change', function() {
		//if the user selected at least one file
			if (this.files && this.files[0]) {
					var img = document.getElementById("myImg");
					//unhide the image
					img.style.display = "block";
					//set the src attribute to the image we just loaded
					img.src = URL.createObjectURL(this.files[0]);
			}
	});
});