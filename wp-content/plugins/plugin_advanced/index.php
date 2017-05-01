<!DOCTYPE html>
<html>
	<head>
		<title>XD</title>
		<meta charset="utf-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	</head>
	<body>
		<p>Click the button to get your coordinates.</p>

		<button onclick="getLocation()">Try It</button>

		<p id="demo"></p>

		<script>
		var x = document.getElementById("demo");

		function getLocation() {
		    if (navigator.geolocation) {
		        navigator.geolocation.getCurrentPosition(showPosition);
		    } else { 
		        x.innerHTML = "Geolocation is not supported by this browser.";
		    }
		}

		function showPosition(position) {
		    x.innerHTML = "Latitude: " + position.coords.latitude + 
		    "<br>Longitude: " + position.coords.longitude;
		}
		</script>
	</body>
</html>