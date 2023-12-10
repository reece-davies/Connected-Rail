<div class="modal fade create-new-company-modal" id="create-new-company-modal" tabindex="-1" role="dialog" aria-labelledby="create-new-company-modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new company profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white; box-shadow: unset !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col" id="append-file-info-here">
                            <!-- data fields -->
                            <input onkeyup="newCompanyNameKeyUp(this)" id="input-company-name" type="text" name="company_name" class="create-modal-field" placeholder="Company Name"/>
                            <input onkeyup="companyImageKeyUp(this)" id="input-company-image" type="text" name="company_logo" class="create-modal-field" placeholder="Company Logo URL"/>
                            <input id="uploaded-company-logo" type="file" accept="image/*" style="display: none" onchange="companyLogoUploaded(this)">
                            <p class="upload-company-image-prompt" onclick="promptForLogoUpload()">Upload a company logo or image?</p>

                            <!-- if the user provides a file, it's name is displayed here (via JavaScript). -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="cancel-create-company-button" type="button" class="modal-btn create-button" data-dismiss="modal">Cancel</button>
                <button id="create-company-button" type="button" class="modal-btn create-button" onclick="createNewCompany()" disabled>Create</button>
            </div>
        </div>
    </div>
</div>

<style>

    .upload-company-image-prompt {
        font-family: 'Raleway', arial;

        margin-top: 10px;
        margin-bottom: 10px;
        margin-left: 5px;

        cursor: pointer;

        font-size: 14px;

        color: #333;
    }

    .upload-company-image-prompt:hover {
        text-decoration: underline;
    }

    .uploaded-file-name {
        margin-top: 5px;
        margin-bottom: 5px;
        margin-left: 5px;

        font-size: 14px;

        color: #333;
    }

    .uploaded-file-name span {
        font-family: 'Raleway', arial;
    }

</style>

<script>

    // Variable tracking the validity of the user input:
    let compNameValid = false;
    let URLvalid = false;

    // User is typing in the new company name input field.
    function newCompanyNameKeyUp(element) {

        if ($(element).val().trim().length === 0)
        {
            $(element).removeClass('invalid').removeClass('valid');
            compNameValid = false;
            $('#create-company-button').prop('disabled', true);
        }
        else if (!($(element).val().includes(';')) && $(element).val().trim().length > 0)
        {
            $(element).removeClass('invalid').addClass('valid');
            compNameValid = true;

            if (URLvalid)
            {
                $('#create-company-button').prop('disabled', false);
            }
        }
        else
        {
            $(element).removeClass('valid').addClass('invalid');
            compNameValid = false;
            $('#create-company-button').prop('disabled', true);
        }

    }

    // User is typing in the new company image input field.
    function companyImageKeyUp(element) {

        let expression = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;
        let regex = new RegExp(expression);

        if ($(element).val().trim().length === 0)
        {
            $(element).removeClass('invalid').removeClass('valid');
            $('#create-company-button').prop('disabled', true);
            URLvalid = false;
        }
        else if (!($(element).val().includes(';')) && $(element).val().trim().length > 0 && $(element).val().match(regex))
        {
            $(element).removeClass('invalid').addClass('valid');
            URLvalid = true;

            if (compNameValid)
            {
                $('#create-company-button').prop('disabled', false);
            }
        }
        else
        {
            $(element).removeClass('valid').addClass('invalid');
            $('#create-company-button').prop('disabled', false);
            URLvalid = false;
        }

    }

    // User has selected that they wish to upload an image with their new company profile.
    function promptForLogoUpload() {

        $('#uploaded-company-logo').click();

    }

    // User has provided an image input into the field.
    function companyLogoUploaded(element) {

        $('.uploaded-file-name').remove();

        // Get the file name:
        let fileName = $(element)[0].files[0].name;

        // Inform the user that their file has been uploaded to the browser:
        $('#append-file-info-here').append('<i class="far fa-check-circle uploaded-file-name"><span> ' + fileName + '</span></i>');

    }

    // Method to process the company creation request.
    function createNewCompany() {

        if (compNameValid && (URLvalid || $('#input-company-image').val().trim().length === 0))
        {
            $.ajax({
                url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_companies",
                type: 'POST',
                data: {
                    COMPANY_NAME: $('#input-company-name').val(),
                    LOGO: $('#input-company-image').val()
                },
                success: function() {

                    // Close the modal:
                    $('#cancel-create-company-button').click();

                    // Alert the user that the account has been created:
                    Swal.fire({
                        position: 'top',
                        type: 'success',
                        title: 'New company has been created!',
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
    function clearCreateNewCompanyModal() {

        compNameValid = false;
        URLvalid = false;
        $('#input-company-name').removeClass('valid').removeClass('invalid');
        $('#input-company-name').val("");
        $('#uploaded-company-logo').val("");
        $('.uploaded-file-name').remove();

    }

</script>