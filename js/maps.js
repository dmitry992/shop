

let map;

function initMap() {
    const chicago = new google.maps.LatLng(41.85, -87.65);
    const map = new google.maps.Map(document.getElementById("map"), {
      center: chicago,
      zoom: 10,
    });
    
}

