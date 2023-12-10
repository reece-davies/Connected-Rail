<div class="modal fade journey-summary-modal" id="" tabindex="-1" role="dialog" aria-labelledby="journey-summary-modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="journey-name">
                    <!-- title of journey is appended here -->
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white; box-shadow: unset !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <h6 class="modal-sub-header">Departure Location:</h6>
                            <input type="text" id="journey-start" class="modal-field" readonly/>

                            <h6 class="modal-sub-header" style="margin-top: 10px">Arrival Location:</h6>
                            <input type="text" id="journey-end" class="modal-field" readonly/>
                        </div>
                    </div>
                    <h6 class="modal-sub-header" style="margin-top: 10px">Journey Price (£):</h6>
                    <div class="row">
                        <div class="col-8">
                            <input onkeyup="editJourneyCostKeyUp(this)" type="text" name="update-journey-price" id="edit-journey-price" class="modal-field" placeholder="57.98" readonly/>
                        </div>
                        <div class="col-2" style="max-width: 10px !important;">
                            <i id="update-journey-icon" class="fas fa-pencil-alt edit-icon" data-mode="update" onclick="enableEditJourneyMode(this)"></i>
                        </div>
                        <div class="col-2" style="max-width: 10px !important;">
                            <i id="save-journey-changes-icon" class="fas fa-save save-icon" onclick="saveJourneyChanges()" style="display: none"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- append something here -->
            </div>
        </div>
    </div>
</div>

<style>



</style>

<script>

    let selectedJourneyId2;
    let selectedJourneyPrice;
    let journeyChangesMade;
    let journeyChangesValid;
    let departureLocationId;
    let arrivalLocationId;

    // Method to load the modal and populate data passed from main HTML file.
    function journeySummaryModalInit(id, leavingLocation, arrivingLocation, price, deptId, arrId) {

        $('#journey-name').text("Journey Summary");
        $('#edit-journey-price').val(price);
        $('#journey-start').val(leavingLocation);
        $('#journey-end').val(arrivingLocation);

        journeyChangesMade      = false;
        journeyChangesValid     = false;

        selectedJourneyId2      = id;
        selectedJourneyPrice    = price;
        departureLocationId     = deptId;
        arrivalLocationId       = arrId;
    }

    // User has decided to edit the price of the journey.
    function enableEditJourneyMode(element) {

        if ($(element).attr('data-mode') == "update")
        {
            // Update what the user is doing.
            $(element).attr('data-mode', 'cancel');
            $(element).removeClass('fa-pencil-alt').addClass('fa-times');

            // Allow the user to make updates
            $('#edit-journey-price').removeClass('invalid').addClass('valid');
            $('#edit-journey-price').prop('readonly', false);
            $('.save-icon').slideDown('fast');

        }
        else
        {
            // Update what the user is doing.
            $(element).attr('data-mode', 'update');
            $(element).removeClass('fa-times').addClass('fa-pencil-alt');

            // Stop the user from making changes:
            $('#edit-journey-price').removeClass('invalid').removeClass('valid');
            $('#edit-journey-price').prop('readonly', true);
            $('.save-icon').slideUp('fast');

            // Revert the users inputs:
            $('#edit-journey-price').val(selectedJourneyPrice);
        }

    }

    // User is updating the price of the selected journey.
    function editJourneyCostKeyUp(element) {

        // Ensure the user has made changes before allowing them to save:
        journeyChangesMade = ($(element).val() !== selectedJourneyPrice);

        if ($(element).val().trim().length > 0 && !($(element).val().includes(';')))
        {
            if (/^[0-9]+(\.[0-9]{1,2})?$/gm.test($(element).val().trim()))
            {
                $(element).removeClass('invalid').addClass('valid');
                journeyChangesValid = true;
            }
            else
            {
                $(element).removeClass('valid').addClass('invalid');
                journeyChangesValid = false;
            }
        }
        else
        {
            $(element).removeClass('valid').addClass('invalid');
            journeyChangesValid = false;
        }

    }


    // User has decided to keep the changes that they have made to the selected journey.
    function saveJourneyChanges() {

        if (journeyChangesMade && journeyChangesValid)
        {
            // Update what the user is doing.
            $('#update-journey-icon').attr('data-mode', 'update');
            $('#update-journey-icon').removeClass('fa-times').addClass('fa-pencil-alt');

            // Stop the user from making changes:
            $('#edit-journey-price').removeClass('invalid').removeClass('valid');
            $('#edit-journey-price').prop('readonly', true);
            $('.save-icon').slideUp('fast');

            $.ajax({
                url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_journey/" + String(selectedJourneyId2),
                type: 'PUT',
                data: {
                    ID: selectedJourneyId2,
                    JOURNEY_COST: $('#edit-journey-price').val(),
                    ARRIVAL_LOCATION_ID: arrivalLocationId,
                    DEPARTURE_LOCATION_ID: departureLocationId
                },
                success: function() {

                    $('.journey-summary-modal').modal('hide');

                    // Inform the user that the data has been edited:
                    Swal.fire({
                        position: 'top',
                        type: 'success',
                        title: 'Journey updated successfully!',
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
    function clearJourneySummaryModal() {

        selectedJourneyId2      = undefined;
        selectedJourneyPrice    = undefined;

        journeyChangesMade      = undefined;
        journeyChangesValid     = undefined;

        // Update what the user is doing.
        $('#update-journey-icon').attr('data-mode', 'update');
        $('#update-journey-icon').removeClass('fa-times').addClass('fa-pencil-alt');

        // Stop the user from making changes:
        $('#edit-journey-price').removeClass('invalid').removeClass('valid');
        $('#edit-journey-price').prop('readonly', true);
        $('.save-icon').slideUp('fast');
    }

</script>