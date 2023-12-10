$(document).ready(function () {

    // Admin has clicked to search through their staff accounts:
    $("#search-staff-accounts").click(function () {

        // Launch the modal:
        //$('.search-staff-modal').modal();

    });

    // Admin has clicked to add a new staff account into the system:
    $("#add-new-staff").click(function () {

        // Launch the modal:
        $('.create-new-staff-modal').modal();

    });

    // Admin has clicked on a staff member in their table.
    $('.staff-member').click(function () {

        // Fetch the clicked staff member's attributes from HTML data:
        let id              = $(this).attr('data-id');
        let image           = $(this).attr('data-image');
        let firstName       = $(this).attr('data-firstName');
        let lastName        = $(this).attr('data-lastName');
        let email           = $(this).attr('data-email');
        let dob             = $(this).attr('data-dob');
        let gender          = $(this).attr('data-gender');
        let role            = $(this).attr('data-role');

        // Launch staff summary modal:
        $('.staff-summary-modal').modal();

        // Pass data through to modal:
        staffSummaryModalInit(id, image, firstName, lastName, email, dob, gender, role);

    });

    // Admin has clicked on a staff member in the journey staff table.
    $(document).on('click', '.journey-staff-member', function() {

        // Fetch the clicked staff member's attributes from HTML data:
        let id              = $(this).attr('data-id');
        let image           = $(this).attr('data-image');
        let firstName       = $(this).attr('data-firstName');
        let lastName        = $(this).attr('data-lastName');
        let email           = $(this).attr('data-email');
        let dob             = $(this).attr('data-dob');
        let gender          = $(this).attr('data-gender');
        let role            = $(this).attr('data-role');

        // Launch staff summary modal:
        $('.journey-staff-summary-modal').modal();

        // Pass data through to modal:
        journeyStaffSummaryModalInit(id, image, firstName, lastName, email, dob, gender, role);

    }) ;

    // Admin has clicked to add some form of new data to the database.
    $('#add-journey-staff').click(function () {

        if (selectedJourney !== null)
        {
            // Load modal:
            $('.add-journey-staff-modal').modal();

            // Pass data through to modal:
            addNewJourneyStaffModalInit(selectedJourney);
        }

    });

    // Store the selected journey:
    let selectedJourney = null;

    // Admin has clicked on a journey.
    $('.journey').click(function () {

        // Make sure the journey isn't already selected before loading data:
        if (!($(this).hasClass('selected-journey')))
        {
            // Get the journey ID to load staff for:
            let journeyId = $(this).attr('data-id');
            selectedJourney = journeyId;

            let cost = $(this).attr('data-cost');

            $('.journey').removeClass('selected-journey');
            $(this).addClass('selected-journey');

            $('#append-journey-staff-here').empty();

            // Display the journey breakdown:
            $('#journey-cost').text("Price:");
            $('#assigned-staff').text("Staff:");
            $('#booked-passengers').text("Passengers:");
            $('#journey-status').text("Status");

            $('#append-journey-staff-here').append('<div class="loader"></div>');

            // Get all journey staff:
            $.ajax({
                url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_journey_staff",
                type: 'GET',
                dataType: 'json',
                success: function (journey_staff) {

                    // Determine which are assigned to this journey:
                    let assignedStaff = [];

                    for (let i = 0; i < journey_staff.length; i++)
                    {
                        if (journey_staff[i]['JOURNEY_ID'] == journeyId)
                        {
                            assignedStaff.push(journey_staff[i]);
                        }
                    }

                    if (assignedStaff.length > 0)
                    {
                        // Get staff profiles based on the assigned staff array:
                        for (let i = 0; i < assignedStaff.length; i++)
                        {
                            $.ajax({
                                url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/staffs/" + assignedStaff[i]['STAFF_ID'],
                                type: 'GET',
                                dataType: 'json',
                                success: function (staffMember) {

                                    if (i === 0)
                                    {
                                        // Display the journey breakdown:
                                        $('#journey-cost').text("Price: £" + cost);
                                        $('#assigned-staff').text("Staff: " + assignedStaff.length);
                                        $('#journey-status').text("On-Time");
                                        $('.loader').remove();
                                    }

                                    // Provide user with a demo image if they have not got their own image:
                                    let photo = staffMember['PHOTO'];

                                    if (photo == "" || photo == null || photo == "null")
                                    {
                                        photo = "https://png.pngtree.com/svg/20170331/1ec867769d.svg";
                                    }

                                    // Display the staff members:
                                    $('#append-journey-staff-here').append(
                                        '<div class="row journey-staff-member"' +
                                        'data-id="' + assignedStaff[i]['ID'] + '"' +
                                        'data-image="' + photo + '"' +
                                        'data-firstName="' + staffMember['FIRST_NAME'] + '"' +
                                        'data-lastName="' + staffMember['LAST_NAME'] + '"' +
                                        'data-email="' + staffMember['EMAIL_ADDRESS'] + '"' +
                                        'data-dob="' + staffMember['DATE_OF_BIRTH'] + '"' +
                                        'data-gender="' + staffMember['GENDER'] + '"' +
                                        'data-role="' + staffMember['STAFF_ROLE'] + '"' +
                                        '>' +
                                            '<!-- staff photo -->' +
                                            '<div class="col-sm">' +
                                            '<p class="staff-image-wrapper">' +
                                                '<img src="' + photo + '" class="staff-image">' +
                                            '</p>' +
                                            '</div>' +
                                            '<!-- staff name -->' +
                                            '<div class="col-sm">' +
                                                '<p class="staff-name staff-information">' + staffMember['FIRST_NAME'] + " " + staffMember['LAST_NAME'] + '</p>' +
                                            '</div>' +
                                            '<!-- staff role -->' +
                                            '<div class="col-sm">' +
                                                '<p class="staff-role staff-information">'+ staffMember['STAFF_ROLE'] +'</p>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="content-divider"></div>'
                                    );

                                    if (i === assignedStaff.length - 1) {
                                        $('#append-journey-staff-here').append('<div style="height: 50px;"></div>');
                                    }
                                }

                            });
                        }
                    }
                    else
                    {
                        // Display the journey breakdown:
                        $('#journey-cost').text("Price: £" + cost);
                        $('#assigned-staff').text("Staff: " + assignedStaff.length);
                        $('#journey-status').text("On-Time");
                        $('.loader').remove();

                        // Display no staff currently assigned:
                        $('#append-journey-staff-here').append(
                            '<p class="no-staff-assigned">No staff assigned.</p>'
                        );
                    }

                }
            });
        }

    });

    // Admin has pressed enter (check if any modals / forms are in focus).
    $(document).on('keypress',function (e) {

        if (e.which == 13)
        {
            if ($('.staff-summary-modal').is(':visible'))
            {
                saveStaffAccountChanges();
            }
            else if ($('.create-new-staff-modal').is(':visible'))
            {
                createNewStaffAccount();
            }
            else if ($('.add-journey-staff-modal').is(':visible'))
            {
                assignStaffToJourney();
            }
        }

    });

    // Admin has closed the staff summary modal.
    $('.staff-summary-modal').on('hidden.bs.modal', function () {

        clearStaffSummaryModal();

    });

    // Admin has closed the create staff modal.
    $('.create-new-staff-modal').on('hidden.bs.modal', function () {

        clearCreateNewStaffModal();

    });

    // Admin has closed the search staff modal.
    $('.search-staff-modal').on('hidden.bs.modal', function () {

        clearSearchStaffModal();

    });

    // Admin has closed the journey staff summary modal.
    $('.journey-staff-summary-modal').on('hidden.bs.modal', function () {

        clearJourneyStaffSummaryModal();

    });

});