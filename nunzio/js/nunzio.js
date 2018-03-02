/*
	Creation of the Google Map
*/
function initMap() {
	
	//Get the div on the page where the map will be placed.
	var mapDiv = document.getElementById('map');
	
	//Latitude and Longitutde for Nunzio & Sons.
	var nunzioLatLng = {lat: 40.817821, lng: -72.942762}
	
	//Create the actual map on the page.
	var map = new google.maps.Map(mapDiv, {
		center: nunzioLatLng,
		zoom: 14
	});
	
//Create marker on the map
	var marker = new google.maps.Marker({
		position: nunzioLatLng,
		map: map,
		icon: 'images/marker.png',
		title: 'Nunzio & Sons'
	});
}