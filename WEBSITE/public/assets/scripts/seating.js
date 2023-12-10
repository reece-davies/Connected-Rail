$(document).ready(function () {

    // Admin has pressed enter (check if any modals / forms are in focus).
    $(document).on('keypress',function (e) {

        if (e.which == 13)
        {
            if ($('.booking-summary-modal').is(':visible'))
            {
                saveBookingChanges();
            }
        }

    });

    // Load modal allowing the admin to view a summary of a passenger's information:
    $('.passenger').click(function () {

        // Fetch booking data from HTML:
        let firstName       = $(this).attr('data-firstName');
        let lastName        = $(this).attr('data-lastName');
        let image           = $(this).attr('data-image');
        let email           = $(this).attr('data-email');
        let dob             = $(this).attr('data-dob');
        let gender          = $(this).attr('data-gender');

        // Launch the modal:
        $('.passenger-summary-modal').modal();

        // Pass data through into the modal:
        passengerSummaryModalInit(firstName, lastName, image, email, dob, gender);

    });

    // Load modal allowing the admin to view a summary of a passenger's booking:
    $('.booking').click(function () {

        // Fetch booking data from HTML:
        let bookingId           = $(this).attr('data-id');
        let passengerId         = $(this).attr('data-passengerId');
        let passengerImage      = $(this).attr('data-image');
        let passengerName       = $(this).attr('data-firstName') + " " + $(this).attr('data-lastName');
        let seatNumber          = $(this).attr('data-seatNumber');
        let seatPreference      = $(this).attr('data-seatPreference');
        let departTime          = $(this).attr('data-departTime');
        let departPlatform      = $(this).attr('data-departurePlatform');
        let arriveTime          = $(this).attr('data-arriveTime');
        let arrivePlatform      = $(this).attr('data-arrivalPlatform');
        let bookingType         = $(this).attr('data-bookingType');
        let email               = $(this).attr('data-email');
        let dob                 = $(this).attr('data-dob');
        let depart              = $(this).attr('data-departLocation');
        let arrive              = $(this).attr('data-arriveLocation');
        let journeyId           = $(this).attr('data-journeyId');

        // Launch the modal:
        $('.booking-summary-modal').modal();

        // Pass data through into the modal:
        bookingSummaryModalInit(bookingId, passengerId, passengerImage, passengerName, seatNumber, seatPreference,
            departTime, departPlatform, arriveTime, arrivePlatform, bookingType, email, dob, depart, arrive, journeyId);

    });

    // Admin has closed the booking summary modal.
    $('.booking-summary-modal').on('hidden.bs.modal', function () {

        clearBookingSummaryModal();

    });

});