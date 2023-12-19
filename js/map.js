// Initialize the map
const map = L.map('map').setView([0, 0], 13);

// Add a tile layer to the map
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Add a marker for the initial location
const marker = L.marker([0, 0]).addTo(map);

// Update the marker with the current location
function updateMarker(location) {
  marker.setLatLng(location);
  map.setView(location);
}

// Connect to the server via Socket.io
const socket = io();

// Get the user's current location using the browser's geolocation API
navigator.geolocation.getCurrentPosition(
  (position) => {
    const initialLocation = [position.coords.latitude, position.coords.longitude];
    map.setView(initialLocation, 13);

    // Add a marker for the initial location
    marker.setLatLng(initialLocation);

    // Send the initial location to the server
    socket.emit('location', { location: initialLocation });
  },
  (error) => {
    console.error(`Error getting location: ${error.message}`);
  }
);

// Listen for location updates from the server
socket.on('location', (location) => {
  console.log('Location update received:', location);

  // Update the marker on the map
  updateMarker(location);
});
