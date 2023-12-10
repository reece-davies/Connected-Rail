<div class="modal fade staff-summary-modal" id="staff-summary-modal" tabindex="-1" role="dialog" aria-labelledby="staff-summary-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-staff-image-wrapper">
                    <img src="" class="modal-staff-image" id="staff-image">
                </p>
                <h5 class="modal-title-override" id="staff-name">
                    <!-- staff members name is appended here -->
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white; box-shadow: unset !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">

                        <!-- staff summary (data) -->
                        <div class="col-6">

                            <!-- header -->
                            <h6 class="modal-sub-header">Staff Details:</h6>

                            <!-- data fields -->
                            <input onkeyup="staffFirstNameKeyUp()" type="text" name="first_name" id="first-name" class="modal-field" placeholder="First Name" readonly/>
                            <br>
                            <input onkeyup="staffLastNameKeyUp()" type="text" name="last_name" id="last-name" class="modal-field" placeholder="Last Name" readonly/>
                            <br>
                            <input onkeyup="staffEmailKeyUp()" type="text" name="email" id="email-address" class="modal-field" placeholder="Email Address" readonly/>
                            <br>
                            <input onkeyup="staffDobKeyUp()" type="text" name="dob" id="date-of-birth" class="modal-field" placeholder="DD/MM/YYYY" readonly/>

                            <!-- select gender -->
                            <select class="modal-select-value form-control" id="select-gender" onchange="updateGenderValue()" disabled>
                                <option class="select-gender-option" value="male">Male</option>
                                <option class="select-gender-option" value="female">Female</option>
                                <option class="select-gender-option" value="study">Other</option>
                            </select>

                            <!-- select role -->
                            <select class="modal-select-value form-control" id="select-role" onchange="updateRoleValue()" disabled>
                                <option class="select-role-option" value="general manager">General Manager</option>
                                <option class="select-role-option" value="cleaner">Cleaner</option>
                                <option class="select-role-option" value="conductor">Conductor</option>
                                <option class="select-role-option" value="retail operative">Retail Operative</option>
                                <option class="select-role-option" value="logistics manager">Logistics Manager</option>
                                <option class="select-role-option" value="partner">Partner</option>
                            </select>
                        </div>

                        <!-- administrator options -->
                        <div class="col-6">

                            <!-- header -->
                            <h6 class="modal-sub-header">Options:</h6>

                            <!-- controls -->
                            <button id="edit-account-button" type="button" class="modal-btn" onclick="editStaffAccount()">Edit Account</button>
                            <br>
                            <button id="delete-account-button" type="button" class="modal-btn" onclick="deleteStaffAccount()">Delete Account</button>
                            <br>

                            <!-- control buttons (save / discard changes) -->
                            <div id="account-controls" class="controls" style="display: none">
                                <button id="save-account-changes-button" type="button" class="modal-btn" onclick="saveStaffAccountChanges()" disabled>Save Changes</button>
                                <br>
                                <button id="discard-account-changes-button" type="button" class="modal-btn" onclick="dropStaffAccountChanges()">Cancel</button>
                            </div>
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

<script>

    // Record of the initial data the modal was loaded with:
    let staffId, staffImage, staffFirstName, staffLastName, staffEmail, staffDob, staffGender, staffRole;

    // Record of what inputs are valid:
    let firstNameValid = true, lastNameValid = true, emailValid = true, dobValid = true;

    // Check if the user has made any changes:
    let changesMade = false;

    // Method to load the modal and populate data passed from main HTML file.
    function staffSummaryModalInit(id, image, firstName, lastName, email, dob, gender, role) {

        // Set data in the modal:
        $('#staff-image').attr('src', image);
        $('#staff-name').text(firstName + " " + lastName);

        // Load data into the input fields:
        $('#first-name').val(firstName);
        $('#last-name').val(lastName);
        $('#email-address').val(email);

        let date_of_birth = new Date(dob);
        $('#date-of-birth').val(date_of_birth.getDate() + "/" + (date_of_birth.getMonth() + 1) + "/" + date_of_birth.getFullYear());

        $('#select-gender').val(gender.toLowerCase());
        $('#select-role').val(role.toLowerCase());

        // Make a record of initial data (so (if) the user reverts, we have a record of what to revert to):
        staffId             = id;
        staffImage          = image;
        staffFirstName      = firstName;
        staffLastName       = lastName;
        staffEmail          = email;
        staffDob            = date_of_birth.getDate() + "/" + (date_of_birth.getMonth() + 1) + "/" + date_of_birth.getFullYear();
        staffGender         = gender;
        staffRole           = role;

    }

    // Method called when the user clicks to edit the account of the selected staff member.
    function editStaffAccount() {

        // Enable all input fields:
        $('.modal-field').prop('readonly', false);
        $('#select-gender').prop('disabled', false);
        $('#select-role').prop('disabled', false);

        // Add valid tags:
        $('.modal-field').removeClass('invalid').addClass('valid');

        // Show controls:
        $('#account-controls').slideDown();

    }

    // User is typing into the first name field.
    function staffFirstNameKeyUp() {

        if (inputIsValid('first-name', $('#first-name').val()))
        {
            $('#first-name').removeClass('invalid').addClass('valid');
            firstNameValid = true;
        }
        else
        {
            $('#first-name').removeClass('valid').addClass('invalid');
            firstNameValid = false;
        }

        staffAccountChangesAreValid();

    }

    // User is typing into the last name field.
    function staffLastNameKeyUp() {

        if (inputIsValid('last-name', $('#last-name').val()))
        {
            $('#last-name').removeClass('invalid').addClass('valid');
            lastNameValid = true;
        }
        else
        {
            $('#last-name').removeClass('valid').addClass('invalid');
            lastNameValid = false;
        }

        staffAccountChangesAreValid();

    }

    // User is typing into the email field.
    function staffEmailKeyUp() {

        if (inputIsValid('email', $('#email-address').val()))
        {
            $('#email-address').removeClass('invalid').addClass('valid');
            emailValid = true;
        }
        else
        {
            $('#email-address').removeClass('valid').addClass('invalid');
            emailValid = false;
        }

        staffAccountChangesAreValid();

    }

    // User is typing into the dob field.
    function staffDobKeyUp() {

        if (inputIsValid('dob', $('#date-of-birth').val()))
        {
            $('#date-of-birth').removeClass('invalid').addClass('valid');
            dobValid = true;
        }
        else
        {
            $('#date-of-birth').removeClass('valid').addClass('invalid');
            dobValid = false;
        }

        staffAccountChangesAreValid();

    }

    // User has adjusted the value in the gender selector.
    function updateGenderValue() {

        // Alert the application that the user is making changes:
        changesMade = true;

        // Try to enable the form submit button:
        staffAccountChangesAreValid();
    }

    // User has adjusted the value in the role selector.
    function updateRoleValue() {

        // Alert the application that the user is making changes:
        changesMade = true;

        // Try to enable the form submit button:
        staffAccountChangesAreValid();

    }

    // Method to ensure the user has input a valid value into the input field.
    function inputIsValid(field, value) {

        // Regex patterns needed to ensure these fields have been filled in correctly:
        let email   = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
        let name    = /^[a-zA-Z]+$/;
        let date    = /(\d+)(-|\/)(\d+)(?:-|\/)(?:(\d+)\s+(\d+):(\d+)(?::(\d+))?(?:\.(\d+))?)?/;

        switch (field) {

            case "first-name":

                if (value.match(name))
                {
                    if (value.toLowerCase() !== staffFirstName.toLowerCase())
                    {
                        // Alert the application that the user is making changes:
                        changesMade = true;
                    }
                    else
                    {
                        changesMade = false;
                    }

                    return true;
                }
                else
                {
                    return false;
                }

            case "last-name":

                if (value.match(name))
                {
                    if (value.toLowerCase() !== staffLastName.toLowerCase())
                    {
                        // Alert the application that the user is making changes:
                        changesMade = true;
                    }
                    else
                    {
                        changesMade = false;
                    }

                    return true;
                }
                else
                {
                    return false;
                }

            case "email":

                if (value.match(email))
                {
                    if (value.toLowerCase() !== staffEmail.toLowerCase())
                    {
                        // Alert the application that the user is making changes:
                        changesMade = true;
                    }
                    else
                    {
                        changesMade = false;
                    }

                    return true;
                }
                else
                {
                    return false;
                }

            case "dob":

                if (value.match(date) && value.length === 10)
                {
                    if (value.toLowerCase() !== staffDob.toLowerCase())
                    {
                        // Alert the application that the user is making changes:
                        changesMade = true;
                    }
                    else
                    {
                        changesMade = false;
                    }

                    return true;
                }
                else
                {
                    return false;
                }

        }
    }

    // Method to ensure the changes being made to the account are valid.
    function staffAccountChangesAreValid() {

        if (firstNameValid && lastNameValid && emailValid && dobValid && changesMade)
        {
            $("#save-account-changes-button").prop('disabled', false);
            return true;
        }
        else
        {
            $("#save-account-changes-button").prop('disabled', true);
            return false;
        }

    }

    // User has made some changes to the selected staff account and wants to save them.
    function saveStaffAccountChanges() {

        if (staffAccountChangesAreValid())
        {
            let date = $('#date-of-birth').val();
            let formattedDate = date.split("/")[2] + "/" +  date.split("/")[1] + "/" + date.split("/")[0];

            $.ajax({
                url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/staffs/" + String(staffId),
                type: 'PUT',
                data: {
                    ID: staffId,
                    EMAIL_ADDRESS: $('#create-email-address').val(),
                    PASSWORD: "password",
                    FIRST_NAME: $('#first-name').val(),
                    LAST_NAME: $('#last-name').val(),
                    DATE_OF_BIRTH: formattedDate,
                    GENDER: $('#select-gender').val(),
                    STAFF_ROLE: $('#select-role').val(),
                    PHOTO: ""
                },
                success: function() {

                    // Ensure all input fields return to being disabled:
                    $('.modal-field').prop('readonly', true);
                    $('#select-gender').prop('disabled', true);
                    $('#select-role').prop('disabled', true);
                    $("#save-account-changes-button").prop('disabled', true);


                    // Remove valid / invalid tags:
                    $('.modal-field').removeClass('valid').removeClass('invalid');

                    // Hide controls:
                    $('#account-controls').slideUp();

                    // Revert values back to true:
                    firstNameValid = lastNameValid = emailValid = dobValid = true;
                    changesMade = false;

                    // Update local variable values:
                    staffFirstName      = $("#first-name").val();
                    staffLastName       = $("#last-name").val();
                    staffEmail          = $("#email-address").val();
                    staffDob            = $("#date-of-birth").val();
                    staffGender         = $("#select-gender").val();

                    // Update the data displayed in the modal:
                    $("#staff-name").text(staffFirstName + " " + staffLastName);

                    // Alert the user that their changes have been saved:
                    Swal.fire({
                        position: 'top',
                        type: 'success',
                        title: 'Your changes have been saved!',
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

    // User has opted to revert the changes they have made to the selected account.
    function dropStaffAccountChanges() {

        // Set data in the modal:
        $('#staff-image').attr('src', staffImage);
        $('#staff-name').text(staffFirstName + " " + staffLastName);

        // Load data into the input fields:
        $('#first-name').val(staffFirstName);
        $('#last-name').val(staffLastName);
        $('#email-address').val(staffEmail);
        $('#date-of-birth').val(staffDob);
        $('#select-gender').val(staffGender.toLowerCase());
        $('#select-role').val(staffRole.toLowerCase());

        // Ensure all input fields return to being disabled:
        $('.modal-field').prop('readonly', true);
        $('#select-gender').prop('disabled', true);
        $('#select-role').prop('disabled', true);
        $("#save-account-changes-button").prop('disabled', true);


        // Remove valid / invalid tags:
        $('.modal-field').removeClass('valid').removeClass('invalid');

        // Hide controls:
        $('#account-controls').slideUp();

        // Revert values back to default:
        firstNameValid = lastNameValid = emailValid = dobValid = true;
        changesMade = false;

    }

    // Method called when the user clicked to delete the account of the selected staff member.
    function deleteStaffAccount() {

        // Display popup asking the user if they are sure they wish to delete an account.
        const swal = Swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
        });

        swal.fire({
            position: 'top',
            title: 'Delete Account?',
            text: "This action cannot be reverted.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it.',
            cancelButtonText: 'No, cancel.',
            reverseButtons: true
        }).then((result) => {

            if (result.value)
            {
                $.ajax({
                    url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/staffs/" + staffId,
                    type: 'DELETE',
                    success: function() {

                        // Get rid of the removed staff member's modal:
                        $('.staff-summary-modal').modal('hide');

                        // Inform the user that the account they wished to delete has been removed successfully.
                        swal.fire({
                            position: 'top',
                            type: 'success',
                            title: 'Account deleted successfully!',
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
                // Inform the user that the account they almost deleted is still active.
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
    function clearStaffSummaryModal() {

        // Remove data in the modal:
        $('#staff-image').attr('src', "");
        $('#staff-name').text("");

        // Remove data from the input fields:
        $('#first-name').val("");
        $('#last-name').val("");
        $('#email-address').val("");
        $('#date-of-birth').val("");
        $('#select-gender').val("");

        // Ensure all input fields return to being disabled:
        $('.modal-field').prop('readonly', true);
        $('#select-gender').prop('disabled', true);
        $('#select-role').prop('disabled', true);
        $("#save-account-changes-button").prop('disabled', true);

        // Remove valid / invalid tags:
        $('.modal-field').removeClass('valid').removeClass('invalid');

        // Hide controls:
        $('#account-controls').hide();

        // Clear values currently stored inside this modal:
        staffId = staffImage = staffFirstName = staffLastName = staffEmail = staffDob = staffGender = staffRole = undefined;

        // Revert values back to default:
        firstNameValid = lastNameValid = emailValid = dobValid = true;
        changesMade = false;

    }

</script>