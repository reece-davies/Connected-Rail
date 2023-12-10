<div class="container-fluid">
    <div class="row">

        <!-- MAP-VIEW -->
        <div class="col-lg-12">
            <div class="map-container">

                <!-- map header -->
                <div class="dashboard-section-header" style="overflow: hidden;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-11">
                                <i class="fas fa-map-marker-alt header-with-icon"><span>Locations</span></i>
                            </div>
                            <div class="col-1">
                                <i class="fas fa-ellipsis-h ellipsis-settings" style="float: right !important; padding-right: 0px !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- map -->
                <div id="map" style="width: 100%; height: 100%"></div>
                <script>

                    // This will be moved into a config file at some point.
                    mapboxgl.accessToken = 'pk.eyJ1IjoiamFtZXNodW50Y29kZSIsImEiOiJjanNubzc2cTkwY3d1NGJtODEwYnVlam1mIn0.6pg92rRf970cNji33b6Ahg';

                    // Initiate the map.
                    var map = new mapboxgl.Map({
                        container: 'map',
                        style: 'mapbox://styles/mapbox/streets-v11',
                        zoom: 5,
                        center: [-2.692337, 53.765762]
                    });

                    // Add controls to the map.
                    map.addControl(new mapboxgl.NavigationControl());

                    // Add some demo data to the map.
                    var geojson = {
                        type: 'FeatureCollection',
                        features: []
                    };

                    //Send AJAX to API to fetch locations from database (then display them on map).
                    getLocations();

                    // Method to get the locations stored in the database (via AJAX request).
                    function getLocations() {

                        $.ajax({
                            url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/locations",
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {

                                //return data;

                                for (let i = 0; i < data.length; i++)
                                {
                                    geojson.features[i] = {
                                        type: 'Feature',
                                        geometry: {
                                            type: 'Point',
                                            coordinates: [data[i]['LONGITUDE'], data[i]['LATITUDE']]
                                        },
                                        properties: {
                                            'marker-color': '#3bb2d0',
                                            'marker-size': 'large',
                                            'marker-symbol': 'rocket'
                                        }
                                    }
                                }

                                geojson.features.forEach(function(marker) {

                                    // Add the marker to the map:
                                    new mapboxgl.Marker()
                                        .setLngLat(marker.geometry.coordinates)
                                        .addTo(map);
                                });

                            }
                        });

                    }

                </script>
            </div>
        </div>

        <!-- TRAIN INFORMATION -->
<!--        <div class="col-lg-6">-->
<!---->
<!--            <!-- arrivals -->
<!--            <div id="arrival-pane" class="dashboard-content-section">-->
<!---->
<!--                <!-- arrivals header -->
<!--                <div class="dashboard-section-header" style="overflow: hidden;">-->
<!--                    <div class="container-fluid">-->
<!--                        <div class="row">-->
<!--                            <div class="col-11">-->
<!--                                <i class="fas fa-train header-with-icon"><span>Arrivals</span></i>-->
<!--                            </div>-->
<!--                            <div class="col-1">-->
<!--                                <i class="fas fa-ellipsis-h ellipsis-settings" style="float: right !important; padding-right: 0px !important;"></i>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <!-- arrivals -->
<!--                <div id="append-arrivals-here" style="margin-top: 10px">-->
<!--                    --><?php
//
//                        for ($i = 0; $i < 10; $i++)
//                        {
//                            echo '
//                            <div class="container-fluid">
//                                <div class="row">
//                                    <div class="col-6">
//                                        <p class="dashboard-information-breakdown content-left">From: Exeter, St. Davids</p>
//                                    </div>
//                                    <div class="col-6">
//                                        <p class="dashboard-information-breakdown content-right">Arriving: 14:25</p>
//                                    </div>
//                                </div>
//                            </div>
//                            <div class="content-divider"></div>
//                            ';
//                        }
//
//                    ?>
<!---->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <!-- departures -->
<!--            <div id="departure-pane" class="dashboard-content-section">-->
<!---->
<!--                <!-- departures header -->
<!--                <div class="dashboard-section-header" style="overflow: hidden;">-->
<!--                    <div class="container-fluid">-->
<!--                        <div class="row">-->
<!--                            <div class="col-11">-->
<!--                                <i class="fas fa-train header-with-icon"><span>Departures</span></i>-->
<!--                            </div>-->
<!--                            <div class="col-1">-->
<!--                                <i class="fas fa-ellipsis-h ellipsis-settings" style="float: right !important; padding-right: 0px !important;"></i>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <!-- departures -->
<!--                <div id="append-departures-here" style="margin-top: 10px">-->
<!---->
<!--                    --><?php
//
//                    for ($i = 0; $i < 10; $i++)
//                    {
//                        echo '
//                            <div class="container-fluid" style="cursor: pointer">
//                                <div class="row">
//                                    <div class="col-6">
//                                        <p class="dashboard-information-breakdown content-left">To: Plymouth, Central Station</p>
//                                    </div>
//                                    <div class="col-6">
//                                        <p class="dashboard-information-breakdown content-right">Departing: 14:25</p>
//                                    </div>
//                                </div>
//                            </div>
//                            <div class="content-divider"></div>
//                            ';
//                    }
//
//                    ?>
<!---->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</div>