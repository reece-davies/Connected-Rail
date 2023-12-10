<div class="container-fluid">
    <div class="row">

        <!-- TRAINS -->
        <div class="col-lg-6">
            <div class="dashboard-content-section slightly-bigger-section">

                <div class="dashboard-section-header" style="overflow: hidden;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8">
                                <i class="fas fa-train header-with-icon"><span>Trains</span></i>
                            </div>
                            <div class="col-4">
                                <i id="add-new-train" class="fas fa-plus add-settings" style="float: right !important; padding-right: 0px !important; margin-right: 5px !important;"></i>
                                <i id="search-trains" class="fas fa-search search-settings" style="float: right !important; padding-right: 0px !important; margin-right: 5px !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- train data -->
                <div class="container-fluid" id="append-trains-here" style="margin-top: 0px;">

                    <?php

                    $result = file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/trains');
                    $data = json_decode($result, true);

                    for ($i = 0; $i < sizeof($data); $i++)
                    {
                        $company = json_decode(file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_companies/' . $data[$i]['TRAIN_COMPANY_ID']), true);

                        echo '
                            <div class="row train">

                            <!-- company name and train type -->
                            <div class="col-sm-10 train-clickable"
                                 data-id="' . $data[$i]['ID'] . '">
                                <p class="train-breakdown train-information">' . $company['COMPANY_NAME'] . ", " .  $data[$i]['TRAIN_TYPE'] . ", " . $data[$i]['ID'] . '</p>
                            </div>
    
                            <!-- remove train icon -->
                            <div class="col-sm-2">
                                <i class="far fa-trash-alt remove-train-icon"
                                   data-id="' . $data[$i]['ID'] . '"
                                ></i>
                            </div>
    
                        </div>
                        <div class="content-divider"></div>
                            ';

                        if ($i == sizeof($data) - 1)
                        {
                            echo '<div style="height: 50px;"></div>';
                        }
                    }

                    ?>

                </div>
            </div>
        </div>

        <!-- TRAIN CARRIAGES -->
        <div class="col-lg-6">
            <div class="dashboard-content-section slightly-bigger-section">

                <div class="dashboard-section-header" style="overflow: hidden;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8">
                                <i class="fas fa-train header-with-icon"><span>Carriages</span></i>
                            </div>
                            <div class="col-4">
                                <i id="add-new-carriage" class="fas fa-plus add-settings" style="float: right !important; padding-right: 0px !important; margin-right: 5px !important;"></i>
                                <i id="search-carriages" class="fas fa-search search-settings" style="float: right !important; padding-right: 0px !important; margin-right: 5px !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- carriage data -->
                <div class="container-fluid" id="append-carriages-here" style="margin-top: 0px;">

                    <?php

                    $result = file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_carriages');
                    $data = json_decode($result, true);

                    for ($i = 0; $i < sizeof($data); $i++)
                    {
                        $train      = json_decode(file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/trains/' . $data[$i]['TRAIN_ID']), true);
                        $carriage   = json_decode(file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/carriages/' . $data[$i]['CARRIAGE_ID']), true);
                        $company    = json_decode(file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_companies/' . $train['ID']), true);

                        echo '
                            <div class="row carriage">
                            <!-- company name and carriage classification -->
                            <div class="col-sm-10 carriage-clickable"
                                 data-id="' .$data[$i]['ID'] . '"
                                 data-trainId="' .$train['ID'] . '"
                                 data-trainName="' . $company['COMPANY_NAME'] . ", " . $carriage['CARRIAGE_CLASSIFICATION'] . '"
                                 data-classification="' . $carriage['CARRIAGE_CLASSIFICATION'] . '"
                                 data-numberOfSeats="' .$carriage[''] . '">
                                <p class="carriage-breakdown train-information">' . $company['COMPANY_NAME'] . ", " . $carriage['CARRIAGE_CLASSIFICATION'] . '</p>
                            </div>
    
                            <!-- remove carriage icon -->
                            <div class="col-sm-2">
                                <i class="far fa-trash-alt remove-carriage-icon"
                                   data-id="' . $data['CARRIAGE_ID'] . '"
                                ></i>
                            </div>
    
                        </div>
                        <div class="content-divider"></div>
                            ';

                        if ($i == sizeof($data) - 1)
                        {
                            echo '<div style="height: 50px;"></div>';
                        }
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <!-- TRAIN JOURNEYS-->
        <div class="col-lg-6">
            <div class="dashboard-content-section slightly-bigger-section">

                <div class="dashboard-section-header" style="overflow: hidden;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8">
                                <i class="fas fa-suitcase header-with-icon"><span>Journeys</span></i>
                            </div>
                            <div class="col-4">
                                <i id="add-new-journey" class="fas fa-plus add-settings" style="float: right !important; padding-right: 0px !important; margin-right: 5px !important;"></i>
                                <i id="search-journeys" class="fas fa-search search-settings" style="float: right !important; padding-right: 0px !important; margin-right: 5px !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- journey data -->
                <div class="container-fluid" id="append-journeys-here" style="margin-top: 0px;">

                    <?php

                    $result = file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_journey');
                    $data = json_decode($result, true);

                    for ($i = 0; $i < sizeof($data); $i++)
                    {
                        $arrival = json_decode(file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/locations/' . $data[$i]['ARRIVAL_LOCATION_ID']), true);
                        $departure = json_decode(file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/locations/' . $data[$i]['DEPARTURE_LOCATION_ID']), true);

                        echo '
                            <div class="row journey">
                            <!-- departure and arrival locations -->
                            <div class="col-sm-10 journey-clickable"
                                    data-id="' . $data[$i]['ID'] . '"
                                    data-journeyCost="' . $data[$i]['JOURNEY_COST'] . '"
                                    data-dept-id="' . $departure['ID'] . '"
                                    data-arr-id="' . $arrival['ID'] . '"
                                    data-departureLocation="' . $departure['TRAIN_STATION_NAME'] . '"
                                    data-arrivalLocation="' . $arrival['TRAIN_STATION_NAME'] . '">
                                <p class="journey-breakdown journey-information-larger">' . $departure['TRAIN_STATION_NAME'] . " to " . $arrival['TRAIN_STATION_NAME'] . '</p>
                            </div>
    
                            <!-- remove journey icon -->
                            <div class="col-sm-2">
                                <i class="far fa-trash-alt remove-journey-icon"
                                   data-id="' . $data[$i]['ID'] . '"
                                ></i>
                            </div>
    
                        </div>
                        <div class="content-divider"></div>
                            ';

                        if ($i == sizeof($data) - 1)
                        {
                            echo '<div style="height: 50px;"></div>';
                        }
                    }

                    ?>

                </div>
            </div>
        </div>

        <!-- TRAIN COMPANIES -->
        <div class="col-lg-6">
            <div class="dashboard-content-section slightly-bigger-section">

                <div class="dashboard-section-header" style="overflow: hidden;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8">
                                <i class="fas fa-building header-with-icon"><span>Companies</span></i>
                            </div>
                            <div class="col-4">
                                <i id="add-new-company" class="fas fa-plus add-settings" style="float: right !important; padding-right: 0px !important; margin-right: 5px !important;"></i>
                                <i id="search-companies" class="fas fa-search search-settings" style="float: right !important; padding-right: 0px !important; margin-right: 5px !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- company data here -->
                <div class="container-fluid" id="append-companies-here" style="margin-top: 0px;">
                    <?php

                    $result = file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_companies');
                    $data = json_decode($result, true);

                    for ($i = 0; $i < sizeof($data); $i++)
                    {
                        echo '
                            <div class="row company"
                                data-id="' . $data[$i]['ID'] . '"
                                data-image="' . $data[$i]['LOGO'] . '"
                                data-companyName="' . $data[$i]['COMPANY_NAME'] . '">

                                <!-- company photo -->
                                <div class="col-sm-2 company-clickable"
                                   data-id="' . $data[$i]['ID'] . '"
                                   data-image="' . $data[$i]['LOGO'] . '"
                                   data-companyName="' . $data[$i]['COMPANY_NAME'] . '">
                                        <img src="' . $data[$i]['LOGO'] . '" class="company-image" style="max-width: 50px">
                                    </p>
                                </div>

                                <!-- company name -->
                                <div class="col-sm-8 company-clickable"
                                    data-id="' . $data[$i]['ID'] . '"
                                    data-image="' . $data[$i]['LOGO'] . '"
                                    data-companyName="' . $data[$i]['COMPANY_NAME'] . '">
                                    <p class="staff-name company-information" style="text-align: center !important;">' . $data[$i]['COMPANY_NAME'] . '</p>
                                </div>
                                
                                <!-- remove company -->
                                <div class="col-sm-2">
                                    <i class="far fa-trash-alt remove-company-icon"
                                    data-id="' . $data[$i]['ID'] . '"
                                    data-companyName="' . $data[$i]['COMPANY_NAME'] . '"></i>
                                </div>

                            </div>
                            <div class="content-divider"></div>
                            ';

                        if ($i == sizeof($data) - 1)
                        {
                            echo '<div style="height: 50px;"></div>';
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- LOCATIONS -->
    <div class="row">
        <div class="col-lg-6">
            <div class="map-container slightly-bigger-section" style="height: 75vh !important;">

                <!-- map header -->
                <div class="dashboard-section-header" style="overflow: hidden;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <i class="fas fa-map-marker-alt header-with-icon"><span>View Locations</span></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- map -->
                <div id="map" style="width: 100%; height: 75vh"></div>
                <script>

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

                    // Define some demo GeoJson data:
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
        <div class="col-lg-6">
            <div class="map-container slightly-bigger-section" style="height: 75vh !important;">

                <div class="dashboard-section-header" style="overflow: hidden;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8">
                                <i class="fas fa-map-marker-alt header-with-icon"><span>Manage Locations</span></i>
                            </div>
                            <div class="col-4">
                                <i id="add-new-location" class="fas fa-plus add-settings" style="float: right !important; padding-right: 0px !important; margin-right: 5px !important;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- location data -->
                <div class="container-fluid" id="append-locations-here" style="margin-top: 0px;">

                    <?php

                    $result = file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/locations');
                    $data = json_decode($result, true);

                    for ($i = 0; $i < sizeof($data); $i++)
                    {
                        echo '
                            <div class="row location">

                            <!-- location name -->
                            <div class="col-sm-10 location-clickable"
                                 data-id="' . $data[$i]['ID'] . '"
                                 data-name="' . $data[$i]['TRAIN_STATION_NAME'] . '"
                                 data-latitude="' . $data[$i]['LATITUDE'] . '"
                                 data-longitude="' . $data[$i]['LONGITUDE'] . '">
                                <p class="location-name location-information">' . $data[$i]['TRAIN_STATION_NAME'] . '</p>
                            </div>
    
                            <!-- remove location icon -->
                            <div class="col-sm-2">
                                <i class="far fa-trash-alt remove-location-icon"
                                   data-id="' . $data[$i]['ID'] . '"
                                   data-name="' . $data[$i]['TRAIN_STATION_NAME'] . '"
                                   ></i>
                            </div>
    
                        </div>
                        <div class="content-divider"></div>
                            ';

                        if ($i == sizeof($data) - 1)
                        {
                            echo '<div style="height: 50px;"></div>';
                        }
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>
</div>