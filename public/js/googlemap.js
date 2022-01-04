
// The following example creates five accessible and
// focusable markers.
var tourStopsa = [];
var datamap = [];
    lok.forEach(item => {
        var geo = {lat: parseFloat(item.lat), lng: parseFloat(item.lng)};
        datamap.push(geo);
        datamap.push(item.nama_lokasi);
        tourStopsa.push(datamap);
        datamap = [];
    });
    console.log(tourStopsa);
    let map;
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        // mapId: "8e0a97af9386fef",
        zoom: 13,
        center: { lat: -7.5973464, lng: 111.9066452 },
        mapTypeControl: false,
    });
    // Set LatLng and title text for the markers. The first marker (Boynton Pass)
    // receives the initial focus when tab is pressed. Use arrow keys to
    // move between markers; press tab again to cycle through the map controls.
    const tourStops = tourStopsa;
    
    // Create an info window to share between markers.
    const infoWindow = new google.maps.InfoWindow();

    // Create the markers.
    tourStops.forEach(([position, title], i) => {
        const marker = new google.maps.Marker({
            position,
            map,
            title: `${i + 1}. ${title}`,
            label: `${i + 1}`,
            optimized: false,
        });

    // Add a click listener for each marker, and set up the info window.
        marker.addListener("click", () => {
            infoWindow.close();
            infoWindow.setContent(marker.getTitle());
            infoWindow.open(marker.getMap(), marker);
        });
    });

    // Add a style-selector control to the map.
  const styleControl = document.getElementById("style-selector-control");

  map.controls[google.maps.ControlPosition.TOP_LEFT].push(styleControl);

  // Set the map's style to the initial value of the selector.
  const styleSelector = document.getElementById("style-selector");

    map.setOptions({ styles: styles["hide"] });
//   map.setOptions({ styles: styles[styleSelector.value] });
  // Apply new JSON when the user selects a different style.
  styleSelector.addEventListener("change", () => {
    map.setOptions({ styles: styles[styleSelector.value] });
  });

  
}

const styles = {
  default: [],
  hide: [
    {
      featureType: "poi.business",
      stylers: [{ visibility: "off" }],
    },
    {
      featureType: "transit",
      elementType: "labels.icon",
      stylers: [{ visibility: "off" }],
    },
  ],
};

// coba 

// ketinggian
// https://developers.google.com/maps/documentation/javascript/examples/elevation-simple

// center
// https://developers.google.com/maps/documentation/javascript/examples/control-custom