$(document).ready(function () {

    // Correct issue with MapBox.js only taking up a small portion of its allocated space.
    window.dispatchEvent(new Event('resize'));

    // Admin has pressed enter (check if any modals / forms are in focus).
    $(document).on('keypress',function (e) {

        if (e.which == 13)
        {
            if ($('.create-new-company-modal').is(':visible'))
            {
                createNewCompany();
            }
            else if ($('.company-summary-modal').is(':visible'))
            {
                saveCompanyChanges();
            }
            else if ($('.add-new-location-modal').is(':visible'))
            {
                addNewLocation();
            }
            else if ($('.add-new-train-modal').is(':visible'))
            {
                addNewTrain();
            }
            else if ($('.add-new-carriage-modal').is(':visible'))
            {
                addNewCarriage();
            }
            else if ($('.add-journey-modal').is(':visible'))
            {
                createNewJourney();
            }
            else if ($('.journey-summary-modal').is(':visible'))
            {
                saveJourneyChanges();
            }
        }

    });

    // Admin has clicked to add a new train:
    $('#add-new-train').click(function () {

        $('.add-new-train-modal').modal();

    });

    // Admin has clicked to remove a train from system records:
    $('.remove-train-icon').click(function () {

        // Fetch the train ID from HTML:
        let trainId = $(this).attr('data-id');

        const swal = Swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
        });

        swal.fire({
            position: 'top',
            title: 'Remove train?',
            text: "Remove this train from system records?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove.',
            cancelButtonText: 'No, cancel.',
            reverseButtons: true
        }).then((result) => {

            if (result.value)
            {
                $.ajax({
                    url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/trains/" + String(trainId),
                    type: 'DELETE',
                    success: function() {

                        // Inform the user that the train has been removed successfully.
                        swal.fire({
                            position: 'top',
                            type: 'success',
                            title: 'Train successfully removed!',
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
                // Inform the user that the train they almost deleted is still on the system.
                swal.fire({
                    position: 'top',
                    type: 'error',
                    title: 'No changes have been made!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });

    });

    // Admin has clicked to add a new train carriage.
    $('#add-new-carriage').click(function () {

        // Show the modal.
        $('.add-new-carriage-modal').modal();

        // Set required values by launching initiation modal.
        addCarriageModalInit();

    });

    // Admin has clicked to see a summary of a specific train carriage.
    // $('.carriage-clickable').click(function () {
    //
    //     // Get the clicked carriage data from HTML:
    //     let id              = $(this).attr('data-id');
    //     let trainId         = $(this).attr('data-trainId');
    //     let trainName       = $(this).attr('data-trainName');
    //     let classification  = $(this).attr('data-classification');
    //     let numberOfSeats   = $(this).attr('data-numberOfSeats');
    //     let carriageName    = $(this).text();
    //
    //     // Launch the modal:
    //     $('.carriage-summary-modal').modal();
    //
    //     // Initiate the modal and pass through the carriage data:
    //     carriageSummaryModalInit(id, trainId, trainName, classification, numberOfSeats, carriageName);
    //
    // });

    // Admin has clicked to remove a train carriage from the application.
    $('.remove-carriage-icon').click(function () {

        // Fetch the carriage ID from HTML:
        let carriageId = $(this).attr('data-id');

        const swal = Swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
        });

        swal.fire({
            position: 'top',
            title: 'Remove carriage?',
            text: "Remove this carriage from system records?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove.',
            cancelButtonText: 'No, cancel.',
            reverseButtons: true
        }).then((result) => {

            if (result.value)
            {
                $.ajax({
                    url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_carriages/" + String(carriageId),
                    type: 'DELETE',
                    success: function() {

                        // Inform the user that the carriage has been removed successfully.
                        swal.fire({
                            position: 'top',
                            type: 'success',
                            title: 'Carriage successfully removed!',
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
                // Inform the user that the carriage they almost deleted is still on the system.
                swal.fire({
                    position: 'top',
                    type: 'error',
                    title: 'No changes have been made!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });

    });

    // Admin has closed the create carriage modal.
    $('.add-new-carriage-modal').on('hidden.bs.modal', function () {

        clearAddCarriageModal();

    });

    // Admin has clicked to add a new journey.
    $('#add-new-journey').click(function () {

        // Launch the modal:
        $('.add-journey-modal').modal();

        // Initiate the modal:
        addJourneyModalInit();

    });

    // Admin has closed the create journey modal.
    $('.add-journey-modal').on('hidden.bs.modal', function () {

        clearAddJourneyModal();

    });

    // Admin has clicked to view a summary of a journey (allow editing in here also - for price etc).
    $('.journey-clickable').click(function () {

        // Fetch the journey data from HTML:
        let id          = $(this).attr('data-id');
        let leaving     = $(this).attr('data-departureLocation');
        let arriving    = $(this).attr('data-arrivalLocation');
        let price       = $(this).attr('data-journeyCost');
        let deptId      = $(this).attr('data-dept-id');
        let arrId       = $(this).attr('data-arr-id');

        // Launch the modal:
        $('.journey-summary-modal').modal();

        // Pass through the data to the modal:
        journeySummaryModalInit(id, leaving, arriving, price, deptId, arrId);

    });

    // Admin has clicked to remove a journey from the system records.
    $('.remove-journey-icon').click(function () {

        // Get ID of the selected journey to remove.
        let id = $(this).attr('data-id');

        const swal = Swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
        });

        swal.fire({
            position: 'top',
            title: 'Remove journey?',
            text: "Remove this journey from system records?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove.',
            cancelButtonText: 'No, cancel.',
            reverseButtons: true
        }).then((result) => {

            if (result.value)
            {
                $.ajax({
                    url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_journey/" + String(id),
                    type: 'DELETE',
                    success: function() {

                        // Inform the user that the journey has been removed successfully.
                        swal.fire({
                            position: 'top',
                            type: 'success',
                            title: 'Journey successfully removed!',
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
                // Inform the user that the journey they almost deleted is still on the system.
                swal.fire({
                    position: 'top',
                    type: 'error',
                    title: 'No changes have been made!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });

    });

    // Admin has closed the create train modal.
    // $('.create-new-train-modal').on('hidden.bs.modal', function () {
    //
    //     clearAddTrainModal();
    //
    // });

    // User wants to add a new company to their system records:
    $('#add-new-company').click(function () {

        // Launch the modal:
        $('.create-new-company-modal').modal();

    });

    // Admin has closed the create company modal.
    $('.create-new-company-modal').on('hidden.bs.modal', function () {

        clearCreateNewCompanyModal();

    });

    // Admin has clicked on a company's profile.
    $('.company-clickable').click(function () {

        // Fetch company data from HTML:
        let id      = $(this).attr('data-id');
        let image   = $(this).attr('data-image');
        let name    = $(this).attr('data-companyName');

        // Launch the modal:
        $('.company-summary-modal').modal();

        // Pass the data through to the modal:
        companySummaryModalInit(id, image, name);

    });

    // Admin has closed the company summary modal.
    $('.company-summary-modal').on('hidden.bs.modal', function () {

        clearCompanySummaryModal();

    });

    // Admin has clicked to remove a company currently in the system:
    $('.remove-company-icon').click(function () {

        // Fetch the company data from HTML:
        let companyId       = $(this).attr('data-id');
        let companyName     = $(this).attr('data-companyName');

        // Confirm with the user that they wish to remove the selected company:
        const swal = Swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
        });

        swal.fire({
            position: 'top',
            title: 'Remove ' + companyName + "?",
            text: "Remove " + companyName + " from system records?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove.',
            cancelButtonText: 'No, cancel.',
            reverseButtons: true
        }).then((result) => {

            if (result.value)
            {
                $.ajax({
                    url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_companies/" + String(companyId),
                    type: 'DELETE',
                    success: function() {

                        // Inform the user that the company has been removed successfully.
                        swal.fire({
                            position: 'top',
                            type: 'success',
                            title: companyName + ' successfully removed!',
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
                // Inform the user that the company they almost deleted is still on the system.
                swal.fire({
                    position: 'top',
                    type: 'error',
                    title: 'No changes have been made!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });

    });

    // Admin has clicked to add a new location to the database:
    $('#add-new-location').click(function () {

        // Launch the modal:
        $('.add-new-location-modal').modal();

        // Initiate the modal:
        addNewLocationModalInit();

    });

    // Resize the new location modal on load (issue with MapBox.js):
    $('.add-new-location-modal').on('shown.bs.modal', function (e) {

        window.dispatchEvent(new Event('resize'));

    });

    // Admin has closed the add new location modal.
    $('.add-new-location-modal').on('hidden.bs.modal', function () {

        clearNewLocationModal();

    });

    // Admin has clicked on a location to see it's full breakdown:
    $('.location-clickable').click(function () {

        // Get the lat & lon values of the selected location:
        let lon = $(this).attr('data-longitude');
        let lat = $(this).attr('data-latitude');

        map.flyTo({
            center: [lon, lat],
            zoom: 14
        });

    });

    // Admin has clicked on a location to remove it from the database:
    $('.remove-location-icon').click(function () {

        // Fetch the location data from HTML:
        let locationId       = $(this).attr('data-id');
        let locationName     = $(this).attr('data-name');

        // Confirm with the user that they wish to remove the selected location:
        const swal = Swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
        });

        swal.fire({
            position: 'top',
            title: 'Remove location?',
            text: "Remove " + locationName + "?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove.',
            cancelButtonText: 'No, cancel.',
            reverseButtons: true
        }).then((result) => {

            if (result.value)
            {
                $.ajax({
                    url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/locations/" + String(locationId),
                    type: 'DELETE',
                    success: function() {

                        // Inform the user that the location has been removed successfully.
                        swal.fire({
                            position: 'top',
                            type: 'success',
                            title: 'Location successfully removed!',
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
                // Inform the user that the location they almost deleted is still on the system.
                swal.fire({
                    position: 'top',
                    type: 'error',
                    title: 'No changes have been made!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });

    });

});