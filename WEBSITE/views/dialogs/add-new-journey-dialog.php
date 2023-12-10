<div class="modal fade add-journey-modal" id="" tabindex="-1" role="dialog" aria-labelledby="add-journey-modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new journey</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white; box-shadow: unset !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- select train -->
                            <h6 class="modal-sub-header">Select Departure Location:</h6>
                            <select class="modal-select-value form-control" id="select-departure-location" onchange="departureUpdated()">
                                <?php

                                    $result = file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/locations');
                                    $data = json_decode($result, true);

                                    for ($i = 0; $i < sizeof($data); $i++)
                                    {
                                        echo '<option class="select-departure-option" value="' . $data[$i]['ID'] . '" selected>' . $data[$i]['TRAIN_STATION_NAME'] . '</option>';
                                    }

                                ?>
                            </select>

                            <!-- select carriage classification -->
                            <h6 class="modal-sub-header" style="margin-top: 10px">Select Arrival Location:</h6>
                            <select class="modal-select-value form-control" id="select-arrival-location" onchange="arrivalUpdated()">
                                <?php

                                $result = file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/locations');
                                $data = json_decode($result, true);

                                for ($i = 0; $i < sizeof($data); $i++)
                                {
                                    echo '<option class="select-arrival-option" value="' . $data[$i]['ID'] . '" selected>' . $data[$i]['TRAIN_STATION_NAME'] . '</option>';
                                }

                                ?>
                            </select>

                            <!-- input number of seats -->
                            <h6 class="modal-sub-header" style="margin-top: 10px">Journey Price (£):</h6>
                            <input onkeyup="journeyCostKeyUp(this)" type="text" name="journey-cost" id="journey-cost" class="modal-field" placeholder="57.98"
                                   style="margin-top: 0px !important;"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-btn create-button" data-dismiss="modal">Cancel</button>
                <button id="create-journey-button" type="button" class="modal-btn create-button" onclick="createNewJourney()" disabled>Add</button>
            </div>
        </div>
    </div>
</div>

<style>



</style>

<script>

    let journeyRouteValid;
    let priceValid;

    // Method to load the modal and populate data passed from main HTML file.
    function addJourneyModalInit() {

        journeyRouteValid   = false;
        priceValid          = false;

    }

    // User has changed the location the journey will begin at.
    function departureUpdated() {

        if (locationsAreDifferent())
        {
            journeyRouteValid = true;
        }
        else
        {
            journeyRouteValid = false;
        }

        canCreateJourney();

    }

    // User has changed the location will end at.
    function arrivalUpdated() {

        if (locationsAreDifferent())
        {
            journeyRouteValid = true;
        }
        else
        {
            journeyRouteValid = false;
        }

        canCreateJourney();

    }


    function locationsAreDifferent()
    {
        return $('#select-departure-location').val() !== $('#select-arrival-location').val();
    }

    // Admin is typing into the input field to allow them to set the price of a new journey.
    function journeyCostKeyUp(element) {

        if ($(element).val().trim().length === 0)
        {
            $(element).removeClass('invalid').removeClass('valid');
            priceValid = false;
        }
        else if ($(element).val().trim().length > 0 && isValidPrice($(element).val().trim()))
        {
            $(element).removeClass('invalid').addClass('valid');
            priceValid = true;
        }
        else
        {
            $(element).addClass('invalid').removeClass('valid');
            priceValid = false;
        }

        canCreateJourney();

    }

    // Method to ensure that the value typed in is valid.
    function isValidPrice(input) {

        return !(input.includes(';')) && (/^[0-9]+(\.[0-9]{1,2})?$/gm.test(input));

    }

    // Method to ensure that the admin can create the new journey (no input errors are present).
    function canCreateJourney() {

        if (journeyRouteValid && priceValid)
        {
            $('#create-journey-button').prop('disabled', false);
        }
        else
        {
            $('#create-journey-button').prop('disabled', true);
        }

    }

    // Method to allow the admin to create a new journey record.
    function createNewJourney() {

        if (journeyRouteValid && priceValid)
        {
            $.ajax({
                url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_journey/",
                type: 'POST',
                data: {
                    JOURNEY_COST: $('#journey-cost').val(),
                    ARRIVAL_LOCATION_ID: $('#select-arrival-location').val(),
                    DEPARTURE_LOCATION_ID: $('#select-departure-location').val()
                },
                success: function() {

                    // Hide this modal:
                    $('.add-journey-modal').modal('hide');

                    swal.fire({
                        position: 'top',
                        type: 'success',
                        title: 'Journey created!',
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
        else if (!journeyRouteValid)
        {
            // Inform the user that the departure location and the arrival location cannot be the same.
            swal.fire({
                position: 'top',
                type: 'error',
                title: 'Error',
                text: 'Arrival and departure locations must be different.',
                showConfirmButton: false,
                timer: 2000
            });
        }

    }

    // Method called when the modal is closed:
    function clearAddJourneyModal() {

        journeyRouteValid   = undefined;
        priceValid          = undefined;

        $('#create-journey-button').prop('disabled', false);

        $('#journey-cost').val("");

        $('#journey-cost').removeClass('invalid').removeClass('valid');
    }

</script>