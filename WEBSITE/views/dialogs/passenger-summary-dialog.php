<div class="modal fade passenger-summary-modal" id="passenger-summary-modal" tabindex="-1" role="dialog" aria-labelledby="passenger-summary-modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-staff-image-wrapper">
                    <img src="" class="modal-staff-image" id="passenger-summary-image">
                </p>
                <h5 class="modal-title-override" id="passenger-summary-name">
                    <!-- passenger's name is appended here -->
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white; box-shadow: unset !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">

                        <!-- passenger summary (data) -->
                        <div class="col-12">

                            <!-- header -->
                            <h6 class="modal-sub-header">Passenger Details:</h6>

                            <!-- data fields -->
                            <input type="text" name="first_name" id="first-name-passenger" class="modal-field" placeholder="First Name" readonly/>
                            <br>
                            <input type="text" name="last_name" id="last-name-passenger" class="modal-field" placeholder="Last Name" readonly/>
                            <br>
                            <input type="text" name="email" id="email-address-passenger" class="modal-field" placeholder="Email Address" readonly/>
                            <br>
                            <input type="text" name="dob" id="date-of-birth-passenger" class="modal-field" placeholder="DD/MM/YYYY" readonly/>

                            <!-- select gender -->
                            <select class="modal-select-value form-control" id="select-passenger-gender" disabled>
                                <option class="select-gender-option" value="male">Male</option>
                                <option class="select-gender-option" value="female">Female</option>
                                <option class="select-gender-option" value="study">Other</option>
                            </select>
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

    // Method called when the modal is loaded to parse data from the main HTML view:
    function passengerSummaryModalInit(firstName,lastName, photo, email, dob, gender) {

        // Set modal data:
        $('#passenger-summary-image').attr('src', photo);
        $('#passenger-summary-name').text(firstName + " " + lastName);
        $('#first-name-passenger').val(firstName);
        $('#last-name-passenger').val(lastName);
        $('#email-address-passenger').val(email);
        let date_of_birth = new Date(dob);
        $('#date-of-birth-passenger').val(date_of_birth.getDate() + "/" + (date_of_birth.getMonth() + 1) + "/" + date_of_birth.getFullYear());
        $('#select-passenger-gender').val(gender.toLowerCase());

    }

</script>