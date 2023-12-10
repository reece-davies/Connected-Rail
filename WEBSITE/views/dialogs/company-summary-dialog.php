<div class="modal fade company-summary-modal" id="company-summary-modal" tabindex="-1" role="dialog" aria-labelledby="company-summary-modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-staff-image-wrapper">
                    <img src="" class="modal-staff-image" id="company-image">
                </p>
                <h5 class="modal-title-override" id="company-name">
                    <!-- company name is appended here -->
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white; box-shadow: unset !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- edit company name -->
                    <div class="row">
                        <div class="col-8">
                            <input onkeyup="companyNameKeyUp(this)" type="text" name="company_name" id="edit-company-name" class="modal-field" placeholder="Company Name" readonly/>
                        </div>
                        <div class="col-2" style="max-width: 10px !important;">
                            <i id="update-company-icon" class="fas fa-pencil-alt edit-icon" data-mode="update" onclick="enableEditCompanyMode(this)"></i>
                        </div>
                        <div class="col-2" style="max-width: 10px !important;">
                            <i id="save-company-changes-icon" class="fas fa-save save-icon" onclick="saveCompanyChanges()" style="display: none"></i>
                        </div>
                    </div>

                    <!-- edit company logo -->
                    <!--<div class="row">
                        <div class="col-12" id="append-updated-file-info-here">
                            <input id="uploaded-updated-company-image" type="file" accept="image/*" style="display: none" onchange="companyLogoUpdated(this)">
                            <p class="upload-company-image-prompt" onclick="promptForNewLogoUpload()">Update company logo or image?</p>
                        </div>
                    </div>-->
                </div>
            </div>
            <div class="modal-footer">
                <!-- append something here? -->
            </div>
        </div>
    </div>
</div>

<style>

    .edit-icon {
        color: dimgrey;
        font-size: 20px;
        cursor: pointer;
        position: relative;
        top: 13px;
        text-align: center;
    }

    .save-icon {
        color: dimgrey;
        font-size: 20px;
        cursor: pointer;
        position: relative;
        top: 13px;
        margin-left: 5px;
        text-align: center;
    }

</style>

<script>

    // Set company data:
    let companyId, companyImage, companyName;

    // Check that the user has actually made changes before sending an API request:
    let changesMade;
    let changesValid;
    let photoUploaded;

    // Method to load the modal and populate data passed from main HTML file.
    function companySummaryModalInit(id, image, name) {

        // Set data in the modal:
        $('#company-image').attr('src', image);
        $('#company-name').text(name);

        // Load data into the input fields:
        $('#edit-company-name').val(name);

        // Make a record of initial data (so (if) the user reverts, we have a record of what to revert to):
        companyId           = id;
        companyImage        = image;
        companyName         = name;
        changesMade         = false;
        changesValid        = false;
        photoUploaded       = false;

    }

    // User has clicked the icon that controls editing the company profile.
    function enableEditCompanyMode(element) {

        if ($(element).attr('data-mode') == "update")
        {
            // Update what the user is doing.
            $(element).attr('data-mode', 'cancel');
            $(element).removeClass('fa-pencil-alt').addClass('fa-times');

            // Allow the user to make updates
            $('#edit-company-name').removeClass('invalid').addClass('valid');
            $('#edit-company-name').prop('readonly', false);
            $('.save-icon').slideDown('fast');

        }
        else
        {
            // Update what the user is doing.
            $(element).attr('data-mode', 'update');
            $(element).removeClass('fa-times').addClass('fa-pencil-alt');

            // Stop the user from making changes:
            $('#edit-company-name').removeClass('invalid').removeClass('valid');
            $('#edit-company-name').prop('readonly', true);
            $('.save-icon').slideUp('fast');

            // Revert the users inputs:
            $('#edit-company-name').val(companyName);
        }

    }

    // User is typing into the company name field:
    function companyNameKeyUp(element) {

        // Ensure the user has made changes before allowing them to save:
        changesMade = ($(element).val() !== companyName);

        if ($(element).val().trim().length > 0 && !($(element).val().includes(';')))
        {
            $(element).removeClass('invalid').addClass('valid');
            changesValid = true;
        }
        else
        {
            $(element).removeClass('valid').addClass('invalid');
            changesValid = false;
        }

    }

    // User has selected that they wish to upload a new logo for the company profile.
    function promptForNewLogoUpload() {

        $('#uploaded-updated-company-image').click();

    }

    // User has uploaded a file from their computer into the file input.
    function companyLogoUpdated(element) {

        // Update what the user is doing.
        $('.edit-icon').attr('data-mode', 'cancel');
        $('.edit-icon').removeClass('fa-pencil-alt').addClass('fa-times');

        // Allow the user to make updates
        $('#edit-company-name').removeClass('invalid').addClass('valid');
        $('#edit-company-name').prop('readonly', false);
        $('.save-icon').slideDown('fast');

        $('.uploaded-file-name').remove();
        photoUploaded = true;

        // Get the file name:
        let fileName = $(element)[0].files[0].name;

        // Inform the user that their file has been uploaded to the browser:
        $('#append-updated-file-info-here').append('<i class="far fa-check-circle uploaded-file-name"><span> ' + fileName + '</span></i>');

    }

    // User has decided to keep the changes that they have made to the selected company profile.
    function saveCompanyChanges() {

        if ((changesMade && changesValid) || photoUploaded)
        {
            // Update what the user is doing.
            $('#update-company-icon').attr('data-mode', 'update');
            $('#update-company-icon').removeClass('fa-times').addClass('fa-pencil-alt');

            // Stop the user from making changes:
            $('#edit-company-name').removeClass('invalid').removeClass('valid');
            $('#edit-company-name').prop('readonly', true);
            $('.save-icon').slideUp('fast');

            // Set the new values:
            companyName = $('#edit-company-name').val();
            $('#company-name').text(companyName);

            if (photoUploaded)
            {
                $('.uploaded-file-name').remove();

                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#company-image')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL($('#uploaded-updated-company-image')[0].files[0]);
            }

            $.ajax({
                url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_companies/" + companyId,
                type: 'PUT',
                data: {
                    ID: companyId,
                    COMPANY_NAME: $('#edit-company-name').val(),
                    LOGO: $('#company-image').attr('src')
                },
                success: function() {

                    // Hide this modal:
                    $('.company-summary-modal').modal('hide');

                    // Inform the user that the data has been edited:
                    Swal.fire({
                        position: 'top',
                        type: 'success',
                        title: 'Company updated successfully!',
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
    function clearCompanySummaryModal() {

        // Remove data in the modal:
        $('#staff-image').attr('src', "");
        $('#staff-name').text("");
        $('.uploaded-file-name').remove();

        // Remove data from the input fields:
        $('#edit-company-name').val("");
        $('#uploaded-updated-company-image').val("");

        // Update what the user is doing.
        $('#update-company-icon').attr('data-mode', 'update');
        $('#update-company-icon').removeClass('fa-times').addClass('fa-pencil-alt');

        // Stop the user from making changes:
        $('#edit-company-name').removeClass('invalid').removeClass('valid');
        $('#edit-company-name').prop('readonly', true);
        $('.save-icon').slideUp('fast');

        $('.uploaded-file-name').remove();

        // Clear values currently stored inside this modal:
        companyId = companyImage = companyName = undefined;
        changesMade     = undefined;
        changesValid    = undefined;
        photoUploaded   = undefined;
    }

</script>