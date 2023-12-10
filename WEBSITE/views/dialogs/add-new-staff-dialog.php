<div class="modal fade create-new-staff-modal" id="create-new-staff-modal" tabindex="-1" role="dialog" aria-labelledby="create-new-staff-modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new staff account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white; box-shadow: unset !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                        <!-- data fields -->
                            <input onkeyup="newFirstNameKeyUp()" type="text" name="first_name" id="create-first-name" class="create-modal-field" placeholder="First Name"/>
                            <br>
                            <input onkeyup="newLastNameKeyUp()" type="text" name="last_name" id="create-last-name" class="create-modal-field" placeholder="Last Name"/>
                            <br>
                            <input onkeyup="newEmailKeyUp()" type="text" name="email" id="create-email-address" class="create-modal-field" placeholder="Email Address"/>
                            <br>
                            <input onkeyup="newDobKeyUp()" type="text" name="dob" id="create-date-of-birth" class="create-modal-field" placeholder="D.O.B (DD/MM/YYYY)"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- select gender -->
                            <select class="modal-select-value form-control" id="create-select-gender">
                                <option class="select-gender-option" value="Male">Male</option>
                                <option class="select-gender-option" value="Female">Female</option>
                                <option class="select-gender-option" value="Other">Other</option>
                            </select>

                            <!-- select role -->
                            <select class="modal-select-value form-control" id="create-select-role">
                                <option class="select-role-option" value="General Manager">General Manager</option>
                                <option class="select-role-option" value="Cleaner">Cleaner</option>
                                <option class="select-role-option" value="Conductor">Conductor</option>
                                <option class="select-role-option" value="Retail Operative">Retail Operative</option>
                                <option class="select-role-option" value="Logistics Manager">Logistics Manager</option>
                                <option class="select-role-option" value="Partner">Partner</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="cancel-create-button" type="button" class="modal-btn create-button" data-dismiss="modal">Cancel</button>
                <button id="create-account-button" type="button" class="modal-btn create-button" onclick="createNewStaffAccount()" disabled>Create Account</button>
            </div>
        </div>
    </div>
</div>

<script>

    // Variables used to track the user inputs:
    let newFirstNameValid = false, newLastNameValid = false, newEmailValid = false, newDobValid = false;

    // User is typing into the first name field.
    function newFirstNameKeyUp() {

        if (createInputIsValid('first-name', $('#create-first-name').val()))
        {
            $('#create-first-name').removeClass('invalid').addClass('valid');
            newFirstNameValid = true;
        }
        else
        {
            $('#create-first-name').removeClass('valid').addClass('invalid');
            newFirstNameValid = false;
        }

        staffAccountCredentialsAreValid();

    }

    // User is typing into the last name field.
    function newLastNameKeyUp() {

        if (createInputIsValid('first-name', $('#create-last-name').val()))
        {
            $('#create-last-name').removeClass('invalid').addClass('valid');
            newLastNameValid = true;
        }
        else
        {
            $('#create-last-name').removeClass('valid').addClass('invalid');
            newLastNameValid = false;
        }

        staffAccountCredentialsAreValid();

    }

    // User is typing into the email field.
    function newEmailKeyUp() {

        if (createInputIsValid('email', $('#create-email-address').val()))
        {
            $('#create-email-address').removeClass('invalid').addClass('valid');
            newEmailValid = true;
        }
        else
        {
            $('#create-email-address').removeClass('valid').addClass('invalid');
            newEmailValid = false;
        }

        staffAccountCredentialsAreValid();

    }

    // User is typing into the DOB field.
    function newDobKeyUp() {

        if (createInputIsValid('dob', $('#create-date-of-birth').val()))
        {
            $('#create-date-of-birth').removeClass('invalid').addClass('valid');
            newDobValid = true;
        }
        else
        {
            $('#create-date-of-birth').removeClass('valid').addClass('invalid');
            newDobValid = false;
        }

        staffAccountCredentialsAreValid();

    }

    // Method to ensure the user has input a valid value into the input field.
    function createInputIsValid(field, value) {

        // Regex patterns needed to ensure these fields have been filled in correctly:
        let email   = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
        let name    = /^[a-zA-Z]+$/;
        let date    = /(\d+)(-|\/)(\d+)(?:-|\/)(?:(\d+)\s+(\d+):(\d+)(?::(\d+))?(?:\.(\d+))?)?/;

        switch (field) {

            case "first-name":

                if (value.match(name))
                {
                    return true;
                }
                else
                {
                    return false;
                }

            case "last-name":

                if (value.match(name))
                {
                    return true;
                }
                else
                {
                    return false;
                }

            case "email":

                if (value.match(email))
                {
                    return true;
                }
                else
                {
                    return false;
                }

            case "dob":

                if (value.match(date) && value.length === 10)
                {
                    return true;
                }
                else
                {
                    return false;
                }

        }
    }

    // Method called to verify all input details are valid.
    function staffAccountCredentialsAreValid() {

        if (newFirstNameValid && newLastNameValid && newEmailValid && newDobValid)
        {
            $("#create-account-button").prop('disabled', false);
            return true;
        }
        else
        {
            $("#create-account-button").prop('disabled', true);
            return false;
        }

    }

    // User has clicked (or pressed enter) signifying they wish to create the account.
    function createNewStaffAccount() {

        if (staffAccountCredentialsAreValid())
        {
            let date = $('#create-date-of-birth').val();
            let formattedDate = date.split("/")[2] + "/" +  date.split("/")[1] + "/" + date.split("/")[0];

            $.ajax({
                url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/staffs",
                type: 'POST',
                data: {
                    EMAIL_ADDRESS: $('#create-email-address').val(),
                    PASSWORD: "password",
                    FIRST_NAME: $('#create-first-name').val(),
                    LAST_NAME: $('#create-last-name').val(),
                    DATE_OF_BIRTH: formattedDate,
                    GENDER: $('#create-select-gender').val(),
                    STAFF_ROLE: $('#create-select-role').val(),
                    PHOTO: ""
                },
                success: function() {

                    // Close the modal:
                    $('#cancel-create-button').click();

                    // Alert the user that the account has been created:
                    Swal.fire({
                        position: 'top',
                        type: 'success',
                        title: 'New account has been created!',
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

    // The modal has been closed, clear the data from it.
    function clearCreateNewStaffModal() {

        // Reset variables back to their default values:
        newFirstNameValid = false, newLastNameValid = false, newEmailValid = false, newDobValid = false;

        // Reset all values back to default.
        $(".create-modal-field").removeClass('valid').removeClass('invalid');
        $(".create-modal-field").val("");
        $("#create-select-gender").val("male");
        $("#create-account-button").prop('disabled', true);

    }

</script>