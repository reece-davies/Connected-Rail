<div class="modal fade add-new-location-modal" id="add-new-location-modal" tabindex="-1" role="dialog" aria-labelledby="add-new-location-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white; box-shadow: unset !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="modal-sub-header" style="margin-left: 5px">Click to add a location</h6>
                            <!-- display a map allowing the user to click on locations they wish to add to the database -->
                            <div id="modal-map"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" name="latitude" id="latitude" class="modal-field location-field" placeholder="Latitude" readonly/>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="longitude" id="longitude" class="modal-field location-field" placeholder="Longitude" readonly/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <input onkeyup="locationInformationKeyUp(this)" data-name="city" type="text" name="location_name" id="location-name" class="modal-field location-field" placeholder="City name" readonly/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <input onkeyup="locationInformationKeyUp(this)" data-name="station" type="text" name="station_name" id="station-name" class="modal-field location-field" placeholder="Station name" readonly/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button id="add-new-location-button" type="button" class="modal-btn" onclick="addNewLocation()" disabled style="display: none">Add Location</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- append something here? -->
            </div>
        </div>
    </div>
</div>

<style>

#modal-map {
    height: 350px;
    width: 100%;

    -webkit-border-radius: 15px;
    -moz-border-radius: 15px;
    border-radius: 15px;

    margin: 0px auto;
}

    .location-field {
        margin-top: 10px !important;
    }

</style>

<script>

    let cityNameValid;
    let stationNameValid;

    // Method called to load data (current locations) into the modal:
    function addNewLocationModalInit() {

        cityNameValid       = false;
        stationNameValid    = false;

        // This will be moved into a config file at some point.
        mapboxgl.accessToken = 'pk.eyJ1IjoiamFtZXNodW50Y29kZSIsImEiOiJjanNubzc2cTkwY3d1NGJtODEwYnVlam1mIn0.6pg92rRf970cNji33b6Ahg';

        // Initiate the map.
        map = new mapboxgl.Map({
            container: 'modal-map',
            style: 'mapbox://styles/mapbox/streets-v11',
            zoom: 4.2,
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

        // Define a single marker that may exist on this map:
        var marker = null;

        // User has clicked on the map:
        map.on('click', function (e) {

            // Remove the existing marker (if exists):
            if (marker !== null)
            {
                marker.remove();
            }

            // Get the lat & lon values:
            let lat = e.lngLat.lat;
            let lon = e.lngLat.lng;

            // Display these values in the input fields:
            $('#latitude').val(lat);
            $('#longitude').val(lon);

            // Drop a marker on the map to confirm with the user where the location they have just added is:
            marker = new mapboxgl.Marker()
                .setLngLat([lon, lat])
                .addTo(map);

            // Allow the user to send this new location to the server:
            $('#add-new-location-button').prop('disabled', false);
            $('#location-name').prop('readonly', false);
            $('#station-name').prop('readonly', false);
            $('#add-new-location-button').slideDown('fast');

        });

    }

    // User is filling in information (typing) into the fields regarding a new location.
    function locationInformationKeyUp(element) {

        if ($(element).val().trim().length === 0)
        {
            $(element).removeClass('valid').removeClass('invalid');

            if ($(element).attr('data-name') === 'city')
            {
                cityNameValid = false;
            }
            else
            {
                stationNameValid = false;
            }
        }
        else if ($(element).val().trim().length > 0 && !($(element).val().includes(';')))
        {
            $(element).addClass('valid').removeClass('invalid');

            if ($(element).attr('data-name') === 'city')
            {
                cityNameValid = true;
            }
            else
            {
                stationNameValid = true;
            }
        }
        else
        {
            $(element).addClass('invalid').removeClass('valid');

            if ($(element).attr('data-name') === 'city')
            {
                cityNameValid = false;
            }
            else
            {
                stationNameValid = false;
            }
        }

    }

    // The user has selected a location to add a new location for a station, handle the request.
    function addNewLocation() {

        if (!($('#add-new-location-button').prop('disabled')) && cityNameValid && stationNameValid)
        {
            $.ajax({
                url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/locations/",
                type: 'POST',
                data: {
                    CITY_NAME: $('#location-name').val(),
                    TRAIN_STATION_NAME: $('#station-name').val(),
                    LATITUDE: $('#latitude').val(),
                    LONGITUDE: $('#longitude').val()
                },
                success: function() {

                    // Hide this modal:
                    $('.add-new-location-modal').modal('hide');

                    // Inform the user that their new location has been added:
                    swal.fire({
                        position: 'top',
                        type: 'success',
                        title: 'Location added successfully!',
                        showConfirmButton: false,
                        timer: 2000
                    });

                    setTimeout(function () {
                        location.reload();
                    }, 2000)
                },
                error: function () {

                    // Do something...
                    // Inform the user that their request could not be completed?

                }
            });
        }

    }

    // Method called when the modal is closed:
    function clearNewLocationModal() {

        // Remove data in the modal:
        $('#latitude').val("");
        $('#longitude').val("");
        $('#add-new-location-button').prop('disabled', true);
        $('#add-new-location-button').hide();
        $('#location-name').prop('readonly', true);
        $('#station-name').prop('readonly', true);
        $('#location-name').val("");
        $('#station-name').val("");
        $('#location-name').removeClass('invalid').removeClass('valid');
        $('#station-name').removeClass('invalid').removeClass('valid');
        cityNameValid = undefined;
        stationNameValid = undefined;

    }

</script>