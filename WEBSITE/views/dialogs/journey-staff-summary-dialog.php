<div class="modal fade journey-staff-summary-modal" id="" tabindex="-1" role="dialog" aria-labelledby="staff-summary-modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-staff-image-wrapper">
                    <img src="" class="modal-staff-image" id="journey-staff-image">
                </p>
                <h5 class="modal-title-override" id="journey-staff-name">
                    <!-- staff members name is appended here -->
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white; box-shadow: unset !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <button id="edit-account-button" type="button" class="modal-btn" onclick="viewStaffFullProfile()">
                                View Full Staff Profile
                            </button>
                            <br>
                            <button id="delete-account-button" type="button" class="modal-btn" onclick="removeStaffFromJourney()">
                                Remove From Journey
                            </button>
                            <br>
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



</style>

<script>

    // Record of the initial data the modal was loaded with:
    let journeyStaffId, journeyStaffImage, journeyStaffFirstName, journeyStaffLastName, journeyStaffEmail, journeyStaffDob, journeyStaffGender, journeyStaffRole;

    // Record the ID of the journey the selected staff member is assigned to:
    let staffJourneyId;

    // Method to load the modal and populate data passed from main HTML file.
    function journeyStaffSummaryModalInit(id, image, firstName, lastName, email, dob, gender, role) {

        // Make a record of initial data:
        journeyStaffId             = id;
        journeyStaffImage          = image;
        journeyStaffFirstName      = firstName;
        journeyStaffLastName       = lastName;
        journeyStaffEmail          = email;
        journeyStaffDob            = dob;
        journeyStaffGender         = gender;
        journeyStaffRole           = role;

        // Set data in the modal:
        $('#journey-staff-image').attr('src', image);
        $('#journey-staff-name').text(firstName + " " + lastName);

    }

    // Method to allow the admin to view the full profile of the selected member of staff.
    function viewStaffFullProfile() {

        // Fetch the clicked staff member's attributes from HTML data:
        let id              = journeyStaffId;
        let image           = journeyStaffImage;
        let firstName       = journeyStaffFirstName;
        let lastName        = journeyStaffLastName;
        let email           = journeyStaffEmail;
        let dob             = journeyStaffDob;
        let gender          = journeyStaffGender;
        let role            = journeyStaffRole;

        // Close this modal:
        $('.journey-staff-summary-modal').modal('hide');

        // Launch staff summary modal:
        $('.staff-summary-modal').modal();

        // Pass data through to modal:
        staffSummaryModalInit(id, image, firstName, lastName, email, dob, gender, role);

    }

    // Method to remove the selected staff member from their assigned journey.
    function removeStaffFromJourney() {

        // Display popup asking the user if they are sure they wish to remove this staff member from this journey.
        const swal = Swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
        });

        swal.fire({
            position: 'top',
            title: 'Remove Staff Member?',
            text: "Remove " + journeyStaffFirstName + " from the selected journey?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove.',
            cancelButtonText: 'No, cancel.',
            reverseButtons: true
        }).then((result) => {

            if (result.value)
            {
                $.ajax({
                    url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_journey_staff/" + journeyStaffId,
                    type: 'DELETE',
                    success: function() {

                        // Get rid of the removed staff member's modal:
                        $('.journey-staff-summary-modal').modal('hide');

                        // Inform the user that the staff member has been unassigned successfully.
                        swal.fire({
                            position: 'top',
                            type: 'success',
                            title: journeyStaffFirstName + ' successfully removed!',
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
            else if (result.dismiss === Swal.DismissReason.cancel)
            {
                // Inform the user that the account they almost unassigned is still on the journey.
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
    function clearJourneyStaffSummaryModal() {

        // Clear values currently stored inside this modal:
        journeyStaffId = journeyStaffImage = journeyStaffFirstName = journeyStaffLastName = journeyStaffEmail = journeyStaffDob = journeyStaffGender = journeyStaffRole = undefined;
        staffJourneyId = undefined;

        // Reset data in the modal:
        $('#journey-staff-image').attr('src', "");
        $('#journey-staff-name').text("");
    }

</script>