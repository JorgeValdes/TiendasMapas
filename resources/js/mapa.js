const { makeArray } = require("jquery");
//const provider = new OpenStreetMapProvider();
const { truncate } = require("lodash");

document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector("#mapa")) {
        const lat = -35.416508;
        const lng = -71.653391;

        const mapa = L.map("mapa").setView([lat, lng], 17);

        //eliminar pines previos

        let markers = new L.FeatureGroup().addTo(mapa);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        let marker;
        let direccion = "";

        // agregar el pin
        // marker = new L.marker([lat, lng]).addTo(mapa);
        marker = new L.marker([lat, lng], {
            draggable: true,
            autoPan: true
        }).addTo(mapa);

        //agregando el pin cuando se inicia el mapa a los grupo de pines para poder limpiarlo despues
        markers.addLayer(marker);

        // Geocode Service
        const geocodeService = L.esri.Geocoding.geocodeService();

        // Buscador de direcciones
        const buscador = document.querySelector("#formbuscador");
        buscador.addEventListener("blur", buscarDireccion); //el lugar de input , ocuparemos el método blur en caso para que pinche por fuera

        reubicarPin(marker);

        function reubicarPin(marker) {
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
                        //console.log("direccion", e.address);
                        direccion = e.address.Address;

                        marker.bindPopup(e.address.Address);
                        marker.openPopup();

                        // Llenar los campos
                        llenarInputs(e);
                    });
            });
        }

        function llenarInputs(e) {
            //console.log("desde llenar inputs", e);
            document.querySelector("#direccion").value =
                e.address.Address || "";
            document.querySelector("#lat").value = e.latlng.lat || "";
            document.querySelector("#lng").value = e.latlng.lng || "";
        }

        function buscarDireccion(e) {
            //console.log("desde buscar direccion");

            const provider = new GeoSearch.OpenStreetMapProvider();

            if (e.target.value.length > 1) {
                //limpiar pines previos
                markers.clearLayers();

                provider
                    .search({
                        query: e.target.value + " TALCA "
                    })
                    .then(e => {
                        if (e[0]) {
                            //console.log(e[0].bounds[0]);

                            geocodeService
                                .reverse()
                                .latlng(e[0].bounds[0], 16)
                                .run(function(error, e) {
                                    // console.log(error);
                                    //lenar los inputs de abajo , centrar el mapa , agregar el Pin , Mover el Pin
                                    //console.log(e);
                                    llenarInputs(e);

                                    mapa.setView(e.latlng);

                                    marker = new L.marker(e.latlng, {
                                        draggable: true,
                                        autoPan: true
                                    }).addTo(mapa);

                                    //asignar el contenedor de market al nuevo pink
                                    markers.addLayer(marker);
                                    ///reubica el pin cuando se realiza el marker
                                    reubicarPin(marker);
                                });
                        }
                    })
                    .catch(error => {
                        //console.log(error);
                    });
            }
        }
    }
});
