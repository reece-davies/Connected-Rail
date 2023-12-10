<div class="modal fade add-journey-staff-modal" id="" tabindex="-1" role="dialog" aria-labelledby="staff-summary-modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign staff member to journey</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white; box-shadow: unset !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <h6 class="modal-sub-header">Select staff member:</h6>

                            <!-- select role -->
                            <select class="modal-select-value form-control" id="select-staff-member">

                                <?php

                                $result = file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/staffs');
                                $data = json_decode($result, true);

                                    for ($i = 0; $i < sizeof($data); $i++)
                                    {
                                        echo '<option class="select-staff-option" value="' . $data[$i]['ID'] . '">' . $data[$i]['FIRST_NAME'] . " " . $data[$i]['LAST_NAME'] . " (" . $data[$i]['STAFF_ROLE']  . ')</option>';
                                    }

                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="cancel-assign-staff-button" type="button" class="modal-btn create-button" data-dismiss="modal">Cancel</button>
                <button id="assign-staff-button" type="button" class="modal-btn create-button" onclick="assignStaffToJourney()">Assign</button>
            </div>
        </div>
    </div>
</div>

<style>

#select-staff-member {
    font-family: 'Raleway', arial;
}

</style>

<script>

    let selectedJourneyId;

    // Method called on modal load to pass through the journey ID the staff member is being assigned to.
    function addNewJourneyStaffModalInit(id) {

        selectedJourneyId = id;

    }

    // Method to allow the admin to actually assign the selected member of staff to the journey.
    function assignStaffToJourney() {

        // Display popup asking the user if they are sure they wish to assign this staff member to this journey.
        const swal = Swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
        });

        swal.fire({
            position: 'top',
            title: 'Assign Staff Member?',
            text: "Assign staff to selected journey?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, assign.',
            cancelButtonText: 'No, cancel.',
            reverseButtons: true
        }).then((result) => {

            if (result.value)
            {
                $.ajax({
                    url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_journey_staff",
                    type: 'POST',
                    data: {
                        STAFF_ID: $('#select-staff-member').val(),
                        JOURNEY_ID: selectedJourneyId
                    },
                    success: function () {

                        // Hide this modal when complete.
                        $('.add-journey-staff-modal').modal('hide');

                        // Inform the user that the staff member has been assigned successfully.
                        swal.fire({
                            position: 'top',
                            type: 'success',
                            title: 'Staff successfully assigned!',
                            showConfirmButton: false,
                            timer: 2000
                        });

                        setTimeout(function () {
                            location.reload();
                        }, 2000)

                    },
                    error: function () {

                        // Do something.
                        // Alert the user that their request has not been completed.

                    }
                });

            }
            else if (result.dismiss === Swal.DismissReason.cancel)
            {
                // Inform the user that the
                swal.fire({
                    position: 'top',
                    type: 'error',
                    title: 'No changes have been made!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });

    }

    // Method called when the modal is closed:
    function clearAddJourneyStaffModal() {

        // Reset variables:
        selectedJourneyId = undefined;

    }

</script>