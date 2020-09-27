const { truncate } = require("lodash");

document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector("#mapa")) {
        const lat = -35.416508;
        const lng = -71.653391;

        const mapa = L.map("mapa").setView([lat, lng], 17);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        let marker;

        // agregar el pin
        // marker = new L.marker([lat, lng]).addTo(mapa);
        marker = new L.marker([lat, lng], {
            draggable: true,
            autoPan: true
        }).addTo(mapa);
        // console.log(marker._latlng);

        const geocodeService = L.esri.Geocoding.geocodeService();

        marker.on("moveend", function(e) {
            // console.log("soltaste el pin");
            marker = e.target;

            //console.log(marker.getLatLng());
            const position = marker.getLatLng();

            //centrar automaticamente
            mapa.panTo(new L.LatLng(position.lat, position.lng));

            //Reverse Geocoding , cuando el usuario reubica el pin
            geocodeService
                .reverse()
                .latlng(position, 16)
                .run(function(error, e) {
                    // console.log(error);
                    console.log("direccion", e.address);

                    const direccion = e.address;
                });

            marker.bindPopup("<b>" + " Calle 9 Oriente 1924-1988" + "<br>");
            marker.openPopup();
        });
        /*      
        marker.on("click", function(e) {
            console.log("click");
        });

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("You clicked the map at " + e.latlng.toString())
                .openOn(mymap);
        } */
    }
});
