let map, popup_f, popup, popup_last, loc_2, client_dest;
var client_distance_2, base_client_duration, client_getlini_duration;

var base_client, client_getlini;


var calculate_1, calculate_2;
var promo_flag = 0;
var rent_per_day = NaN;
var lat, lng;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        mapTypeControl: false,
        center: { lat: 56.955861, lng: 24.000531 },
        zoom: 8,
        streetViewControl: false
    });

    // new AutocompleteDirectionsHandler(map);

    // class Popup extends google.maps.OverlayView {
    //     position;
    //     containerDiv;
    //     constructor(position, content) {
    //         super();
    //         this.position = position;
    //         content.classList.add("popup-bubble");

    //         // This zero-height div is positioned at the bottom of the tip.
    //         this.containerDiv = document.createElement("div");
    //         this.containerDiv.classList.add("popup-container");

    //         this.containerDiv.appendChild(content);

    //         // Optionally stop clicks, etc., from bubbling up to the map.
    //         Popup.preventMapHitsAndGesturesFrom(this.containerDiv);
    //     }


    //     /** Called when the popup is added to the map. */
    //     onAdd() {
    //         this.getPanes().floatPane.appendChild(this.containerDiv);
    //     }
    //     /** Called when the popup is removed from the map. */
    //     onRemove() {
    //         if (this.containerDiv.parentElement) {
    //             this.containerDiv.parentElement.removeChild(this.containerDiv);
    //         }
    //     }
    //     /** Called each frame when the popup needs to draw itself. */
    //     draw() {
    //         const divPosition = this.getProjection().fromLatLngToDivPixel(
    //             this.position
    //         );
    //         // Hide the popup when it is far out of view.
    //         const display =
    //             Math.abs(divPosition.x) < 4000 && Math.abs(divPosition.y) < 4000
    //                 ? "block"
    //                 : "none";

    //         if (display === "block") {
    //             this.containerDiv.style.left = divPosition.x + "px";
    //             this.containerDiv.style.top = divPosition.y + "px";
    //         }

    //         if (this.containerDiv.style.display !== display) {
    //             this.containerDiv.style.display = display;
    //         }
    //     }
    // }

    // let client_geo = { lat: lat, lng: lng };

    popup_f = function (client_geo) {

        // popup = new Popup(
        //     new google.maps.LatLng(client_geo.lat, client_geo.lng),
        //     document.getElementById("content")
        // );



        // if (popup_last) {
        //     popup_last.setMap(null);
        // }

        new google.maps.Marker({
            position: client_geo,
            map,
            title: "Hello World!",
          });

        // popup.setMap(map);

        map.setZoom(16);

        map.setCenter(client_geo);

        // popup_last = popup;

            if(document.getElementById('next_2'))
                    document.getElementById('next_2').setAttribute('style', '');

        new AutocompleteDirectionsHandler_2(client_geo);

    }

    // this.base_geo = {lat: 56.927433, lng: 24.284458};
    popup_f({lat: 56.927433, lng: 24.284458});


}

















// class AutocompleteDirectionsHandler {
//     map;
//     originPlaceId;
//     destinationPlaceId;
//     travelMode;
//     directionsService;
//     directionsRenderer;
//     constructor(map) {
//         this.map = map;
//         this.originPlaceId = "";
//         this.destinationPlaceId = "";
//         this.travelMode = google.maps.TravelMode.DRIVING;
//         this.directionsService = new google.maps.DirectionsService();
//         this.directionsRenderer = new google.maps.DirectionsRenderer();
//         this.directionsRenderer.setMap(map);
//         this.popup;

//         const destinationInput = document.getElementById("destination-input");

//         // const destinationAutocomplete = new google.maps.places.Autocomplete(
//         //     destinationInput
//         // );

//         // Specify just the place data fields that you need.

//         // destinationAutocomplete.setFields(["place_id", "geometry", "name", "formatted_address"]);

//         // this.setupPlaceChangedListener(destinationAutocomplete, "DEST");



//         // this.setPoint();

//     }


//     // Sets a listener on a radio button to change the filter type on Places
//     // Autocomplete.

//     setPoint() {
//         this.destinationPlaceId = { lat: place.geometry.location.lat(), lng: place.geometry.location.lng() };

//         lat = place.geometry.location.lat();
//         lng = place.geometry.location.lng();

//         this.map.setZoom(15);
//         this.map.setCenter(this.destinationPlaceId);
//         this.route();
//     }


//     // setupPlaceChangedListener(autocomplete, mode) {

//     //     autocomplete.bindTo("bounds", this.map);

//     //     autocomplete.addListener("place_changed", () => {

//     //         const place = autocomplete.getPlace();

//     //         if (!place.place_id) {
//     //             window.alert("Please select an option from the dropdown list.");
//     //             return;
//     //         }

//     //         this.destinationPlaceId = { lat: place.geometry.location.lat(), lng: place.geometry.location.lng() };

//     //         lat = place.geometry.location.lat();
//     //         lng = place.geometry.location.lng();

//     //         this.map.setZoom(15);
//     //         this.map.setCenter(this.destinationPlaceId);
//     //         this.route();
//     //     });

//     // }

//     route() {

//         const me = this;
//         this.directionsService.route(
//             {
//                 //Origin Ulbroka base
//                 origin: new google.maps.LatLng(56.927417, 24.282639),

//                 // Destination client
//                 destination: this.destinationPlaceId,
//                 travelMode: this.travelMode,
//             },
//             (response, status) => {
//                 if (status === "OK") {

//                     const route = response.routes[0];

//                     for (let i = 0; i < route.legs.length; i++) {

//                         base_client = route.legs[i].distance.value;
//                         base_client_duration = route.legs[i].duration.text;

//                         console.log("base_client: " + base_client);
//                         console.log("base_client_duration: " + base_client_duration);
//                     }

//                     popup_f(this.destinationPlaceId);

//                 } else {
//                     window.alert("Directions request failed due to " + status);
//                 }

//             }
//         );
//     }
// }

// // var lat_2, lng_2;

class AutocompleteDirectionsHandler_2 {

    base_geo;
    originPlaceId;
    destinationPlaceId;
    travelMode;
    directionsService;

    constructor(client_dest) {

        // Base geo location - Poligons "Ievas", Ulbroka, Stopiņu nov., LV-2130
        this.base_geo = {lat: 56.927433, lng: 24.284458}; //new google.maps.LatLng(56.927433, 24.284458); // {lat: 56.927433, lng: 24.284458}

        // Client address geo location
        this.client_geo = client_dest; 

        // Getlini geo location -  Kaudzīšu iela 57
        this.getlini_geo = new google.maps.LatLng(56.8849974, 24.2600705);

        this.travelMode = google.maps.TravelMode.DRIVING;

        this.directionsService = new google.maps.DirectionsService();

        this.route_base_client();

        this.route_client_getlini();

    }


    route_base_client() {

        this.directionsService.route(
            {

                origin: this.base_geo,
                destination: this.client_geo,
                travelMode: this.travelMode,
                provideRouteAlternatives: true

            }, (response, status) => {

                if (status === "OK") {

                } else {
                    window.alert("Directions request failed due to " + status);
                }

                var shortest = this.shortestRoute(response);

                // this.directionsDisplay.setDirections(shortest);

                const route = shortest.routes[0];

                // const route = response.routes[0];

                for (let i = 0; i < route.legs.length; i++) {
                    base_client = parseInt(route.legs[i].distance.value) / 1000;
                }

                console.log('base_client: ' + base_client);
            }
        );
    }

    route_client_getlini() {

        this.directionsService.route(
            {
                
                origin: this.client_geo,
                destination: this.getlini_geo,
                travelMode: this.travelMode,

            }, (response, status) => {
                if (status === "OK") {

                } else {
                    window.alert("Directions request failed due to " + status);
                }

                var shortest = this.shortestRoute(response);
                // this.directionsDisplay.setDirections(shortest);

                const route = shortest.routes[0];

                // const route = response.routes[0];

                for (let i = 0; i < route.legs.length; i++) {
                    client_getlini = parseInt(route.legs[i].distance.value) / 1000;
                }

                // route.legs[i].time.value   

           
                // if(promo_flag == 0){

                //     calculate_1();
                // }else{
                //     calculate_2();
                // }

                console.log('client_getlini: ' + client_getlini);
         
            }
        );
    }

    shortestRoute = function (routeResults) {
        var shortestRoute = routeResults.routes[0];
        var shortestLength = shortestRoute.legs[0].distance.value;
        for (var i = 1; i < routeResults.routes.length; i++) {
            if (routeResults.routes[i].legs[0].distance.value < shortestLength) {
                shortestRoute = routeResults.routes[i];
                shortestLength = routeResults.routes[i].legs[0].distance.value;
            }
        }
        routeResults.routes = [shortestRoute];
        return routeResults;
    };


}

























//Other








// function initMap_2(dest) {
//     var origin1 = new google.maps.LatLng(56.927417, 24.282639);
//     var origin2 = 'Greenwich, England';
//     var destinationA = dest;
//     var destinationB = new google.maps.LatLng(50.087692, 14.421150);

//     var service = new google.maps.DistanceMatrixService();
//     service.getDistanceMatrix(
//         {
//             origins: [origin1, origin2],
//             destinations: [destinationA, destinationB],
//             travelMode: 'DRIVING',
//             drivingOptions: {
//                 departureTime: new Date(Date.now() + 0),  // for the time N milliseconds from now.
//                 trafficModel: 'bestguess'
//             }
//         }, callback);

//     function callback(response, status) {
//         // See Parsing the Results for
//         // the basics of a callback function.
//         if (status == 'OK') {
//             var origins = response.originAddresses;
//             var destinations = response.destinationAddresses;
//             console.log(origins);
//             console.log(destinations);

//             for (var i = 0; i < origins.length; i++) {
//                 var results = response.rows[i].elements;
//                 for (var j = 0; j < results.length; j++) {

//                     var element = results[j];
//                     var distance = element.distance.text;
//                     var duration = element.duration.text;
//                     var from = origins[i];
//                     var to = destinations[j];
//                     console.log("Distance: " + element.distance.text);
//                     console.log("Duration: " + element.duration.text);
//                     console.log("From: " + origins[i]);
//                     console.log("To: " + destinations[j]);

//                 }
//             }
//         }
//     }
// }