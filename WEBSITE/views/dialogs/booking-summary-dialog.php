<div class="modal fade booking-summary-modal" id="booking-summary-modal" tabindex="-1" role="dialog" aria-labelledby="booking-summary-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-staff-image-wrapper">
                    <img src="" class="modal-staff-image" id="booking-image">

                </p>
                <h5 class="modal-title-override" id="passenger-booking-name">
                    <!-- passenger's name is appended here -->
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white; box-shadow: unset !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">

                        <!-- booking summary (data) -->
                        <div class="col-6">

                            <!-- header -->
                            <h6 class="modal-sub-header">Booking Details:</h6>

                            <!-- data fields -->
                            <input type="text" name="email" id="passenger-email-address" class="modal-field" placeholder="Email Address" readonly/>
                            <br>
                            <!--<input type="text" name="dob" id="passenger-date-of-birth" class="modal-field" placeholder="DD/MM/YYYY" readonly/>
                            <br>-->
                            <input onkeyup="seatNumberOnKeyUp(this)" type="text" name="seat_no" id="passenger-seat-number" class="modal-field" placeholder="5" readonly/>
                            <br>
                            <input type="text" name="seat-preference" id="passenger-seat-preference" class="modal-field" placeholder="Window" readonly/>
                            <br>
                            <input type="text" name="depart_time" id="depart-time" class="modal-field" placeholder="DD/MM/YYYY HH:MM" readonly/>
                            <br>
                            <input type="text" name="depart_platform" id="depart-platform" class="modal-field" placeholder="2" readonly/>
                            <br>
                            <input type="text" name="arrive_time" id="arrive-time" class="modal-field" placeholder="DD/MM/YYYY HH:MM" readonly/>
                            <br>
                            <input type="text" name="arrive_platform" id="arrive-platform" class="modal-field" placeholder="3" readonly/>
                            <br>
                            <input type="text" name="booking_classification" id="booking-type" class="modal-field" placeholder="Standard" readonly/>
                            <br>
                            <input type="text" name="departure_location" id="depart-from" class="modal-field" placeholder="Plymouth Central Station" readonly/>
                            <br>
                            <input type="text" name="arrive_location" id="arrive-at" class="modal-field" placeholder="Exeter St. Davids" readonly/>

                        </div>

                        <!-- administrator options -->
                        <div class="col-6">

                            <!-- header -->
                            <h6 class="modal-sub-header">Options:</h6>

                            <!-- controls -->
                            <button id="edit-booking-button" type="button" class="modal-btn" onclick="updateBookingDetails()">Edit Booking</button>
                            <br>
                            <button id="delete-booking-button" type="button" class="modal-btn" onclick="deleteBooking()">Delete Booking</button>
                            <br>

                            <!-- control buttons (save / discard changes) -->
                            <div id="account-controls" class="controls" style="display: none">
                                <button id="save-booking-changes-button" type="button" class="modal-btn" onclick="saveBookingChanges()" disabled>Save Changes</button>
                                <br>
                                <button id="discard-booking-changes-button" type="button" class="modal-btn" onclick="cancelBookingChanges()">Cancel</button>
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

    // Variables needed to track booking data (& store the initial state):
    let bookingID;
    let passengerID;
    let journeyId3;
    let seatNumber;
    let seatPreference;
    let departureTime;
    let departurePlatform;
    let arrivalTime;
    let arrivalPlatform;
    let bookingClassification;

    let changesValid = false;

    // Method called when the modal is launched to pass data through from the main HTML page:
    function bookingSummaryModalInit(bookingId, passengerId, image, name, seatNo, seatPref,
                                     departTime, departPlatform, arriveTime, arrivePlatform, bookingType, email, dob, departLoc, arriveLoc, journeyId) {

        // Set data inside the modal:
        $('#booking-image').attr('src', image);
        $('#passenger-booking-name').text(name);
        $('#passenger-email-address').val("Passenger: " + email);

        // let date_of_birth = new Date(dob);
        // $('#passenger-date-of-birth').val(date_of_birth.getDate() + "/" + (date_of_birth.getMonth() + 1) + "/" + date_of_birth.getFullYear());

        $('#passenger-seat-number').val("Seat: " + seatNo);
        $('#passenger-seat-preference').val("Seat preference: " + seatPref);

        let depart = new Date(departTime);
        let arrive = new Date(arriveTime);
        $('#depart-time').val("Depart: " + depart.getDate() + "/" + (depart.getMonth() + 1) + "/" + depart.getFullYear() + " " + depart.getHours() + ":" + depart.getMinutes());
        $('#arrive-time').val("Arrive: " + arrive.getDate() + "/" + (arrive.getMonth() + 1) + "/" + arrive.getFullYear() + " " + depart.getHours() + ":" + depart.getMinutes());

        $('#depart-platform').val("Departure Platform: " + departPlatform);
        $('#arrive-platform').val("Arrival Platform: " + arrivePlatform);
        $('#booking-type').val("Booking Type: " + bookingType);

        $('#depart-from').val("From: " + departLoc);
        $('#arrive-at').val("To: " + arriveLoc);

        // Assign (more global) variables their values:
        bookingID               = bookingId;
        passengerID             = passengerId;
        seatNumber              = seatNo;
        departureTime           = departTime;
        departurePlatform       = departPlatform;
        arrivalTime             = arriveTime;
        arrivalPlatform         = arrivePlatform;
        bookingClassification   = bookingType;
        seatPreference          = seatPref;
        journeyId3              = journeyId;

    }

    // Method allowing an administrator to make changes to a passengers booking:
    function updateBookingDetails() {

        // Display admin controls:
        $('#account-controls').slideDown();

        $('#passenger-seat-number').prop('readonly', false);
        $('#passenger-seat-number').val(seatNumber);
        $('#passenger-seat-number').removeClass('invalid').addClass('valid');

    }

    // Method called when the user is typing into the seat number field:
    function seatNumberOnKeyUp(element) {

        if ($(element).val().trim().length === 0)
        {
            changesValid = false;
            $('#passenger-seat-number').removeClass('invalid').removeClass('valid');
        }
        else if ($(element).val().trim().length > 0 && $(element).val().trim() !== seatNumber && !isNaN($(element).val().trim()))
        {
            changesValid = true;
            $(element).addClass('valid').removeClass('invalid');
        }
        else
        {
            changesValid = false;
            $(element).removeClass('valid').addClass('invalid');
        }

    }

    // Method allowing the admin's changes to be saved:
    function saveBookingChanges() {

        if (changesValid)
        {
            $.ajax({
                url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/bookings/" + String(bookingID),
                type: 'PUT',
                data: {
                    ID: bookingID,
                    PASSENGER_ID: passengerID,
                    JOURNEY_ID: journeyId3,
                    BOOKING_TYPE: bookingClassification,
                    SEAT_NUMBER: $('#passenger-seat-number').val(),
                    SEAT_PREFERENCE: seatPreference,
                    DEPARTURE_DATE_TIME: departureTime,
                    DEPARTURE_PLATFORM: departurePlatform,
                    ARRIVAL_DATE_TIME: arrivalTime,
                    ARRIVAL_PLATFORM: arrivalPlatform
                },
                success: function() {

                    $('#account-controls').hide();
                    $('#passenger-seat-number').prop('readonly', true);
                    $('#passenger-seat-number').removeClass('invalid').removeClass('valid');
                    $('#passenger-seat-number').val("Seat: " + $('#passenger-seat-number').val());

                    // Inform the user that the booking has been updated successfully.
                    swal.fire({
                        position: 'top',
                        type: 'success',
                        title: 'Booking updated successfully!',
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

    // Method to allow the admin to cancel the changes they have made to the booking:
    function cancelBookingChanges() {

        // Hide controls:
        $('#account-controls').slideUp();
        $('#passenger-seat-number').val("Seat: " + seatNumber);
        $('#passenger-seat-number').prop('readonly', true);

    }

    // Method to allow the admin to delete a customer's booking:
    function deleteBooking() {

        // Display popup asking the user if they are sure they wish to delete an booking.
        const swal = Swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
        });

        swal.fire({
            position: 'top',
            title: 'Delete Booking?',
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
                    url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/bookings/" + String(bookingID),
                    type: 'DELETE',
                    success: function() {

                        // Hide this modal:
                        $('.booking-summary-modal').modal('hide');

                        // Inform the user that the booking they wished to delete has been removed successfully.
                        swal.fire({
                            position: 'top',
                            type: 'success',
                            title: 'Booking deleted successfully!',
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
                // Inform the user that the booking they almost deleted is still active.
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

    // Method called when the modal is closed to revert all data / erase unsaved changes:
    function clearBookingSummaryModal() {

        // Clear values:
        bookingID               = undefined;
        passengerID             = undefined;
        seatNumber              = undefined;
        seatPreference          = undefined;
        departureTime           = undefined;
        departurePlatform       = undefined;
        arrivalTime             = undefined;
        arrivalPlatform         = undefined;
        bookingClassification   = undefined;

        // Hide controls:
        $('#account-controls').hide();
        $('#passenger-seat-number').prop('readonly', true);
        $('#passenger-seat-number').removeClass('invalid').removeClass('valid');

    }

</script>