<div class="modal fade search-staff-modal" id="search-staff-modal" tabindex="-1" role="dialog" aria-labelledby="search-staff-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Search staff accounts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white; box-shadow: unset !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <!-- search bar -->
                        <input onkeyup="staffSearchKeyUp()" type="text" name="staff_search" id="staff-account-search-query" class="search-staff-modal-field" placeholder="Search..."/>
                    </div>

                    <!-- wrapper for the appended staff accounts -->
                    <div class="row modal-staff-account-wrapper">

                        <!-- results for the user's inputs will be appended below -->
                        <div class="staff-search-results-appended-here">

                            <?php

                            for ($i = 0; $i < 10; $i++)
                            {
                                echo '
                                    <div class="row modal-staff-member"
                                        data-id="-1"
                                        data-image="https://www.meme-arsenal.com/memes/9a7ca28761ad7a577d70d6bac1579fdf.jpg"
                                        data-firstName="Harold"
                                        data-lastName="Grimes"
                                        data-email="harold.grimes@connectedrail.com"
                                        data-dob="01/01/1960"
                                        data-gender="Male"
                                        data-role="Conductor"
                                        onclick="searchResultClicked(this)">
        
                                        <!-- staff photo -->
                                        <div class="col-md">
                                            <p class="modal-staff-image-wrapper">
                                                <img src="https://www.meme-arsenal.com/memes/9a7ca28761ad7a577d70d6bac1579fdf.jpg" class="search-modal-staff-image">
                                            </p>
                                        </div>
                
                                        <!-- staff name -->
                                        <div class="col-md">
                                            <p class="modal-staff-information">Harold Grimes</p>
                                        </div>
                
                                        <!-- role -->
                                        <div class="col-md">
                                            <p class="modal-staff-information float-modal-role-right">Conductor</p>
                                        </div>
        
                                    </div>
                                    <div class="content-divider"></div>
                                    ';
                            }

                            ?>

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

    .modal-staff-account-wrapper {
        min-height: 200px;
        height: 38vh;

        overflow: hidden;

        background: grey !important;
        background: -webkit-linear-gradient(left, teal, grey) !important;
        background: -o-linear-gradient(left, teal, grey) !important;
        background: -moz-linear-gradient(left, teal, grey) !important;
        background: linear-gradient(left, teal, grey) !important;

        margin-top: 10px;
        margin-bottom: 10px;

        border-radius: 15px;

        padding: 3px;
    }

    .staff-search-results-appended-here {
        height: 100%;
        width: 100%;

        background: white;

        border-radius: 12px;

        overflow-y: scroll;
    }

    .search-staff-modal-field {
        width: 100%;

        padding: 5px;

        margin-top: 5px;
        margin-bottom: 5px;

        font-family: "Raleway", arial;

        border-radius: 15px;

        outline-color: transparent;
        outline-style: none;

        border-radius: 10px;
        border-style: solid;
        border-width: 2px;
        border-color: lightgray;

        -webkit-transition: all ease 0.25s;
        transition: all ease 0.25s;
    }

    .staff-search-results-appended-here::-webkit-scrollbar {
        display: none;
    }

    .modal-staff-member {
        cursor: pointer;

        -webkit-transition: all 0.25s;
        transition: all 0.25s;

        padding-top: 5px;
        padding-bottom: 5px;
    }

    .modal-staff-member:hover {
        background-color: #F5F5F5;
    }

    .modal-staff-member p:hover {
        text-decoration: underline;
    }

    .modal-staff-image-wrapper {
        margin-left: 10px;
    }

    .search-modal-staff-image {
        height: 50px;
        width: 50px;

        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;

        box-shadow: 0px 0px 10px darkgrey;
    }

    .modal-staff-information {
        font-family: 'Raleway', arial;
        font-size: 16px;

        color: #333;

        text-align: center;

        margin-top: 20px;
    }

    .float-modal-role-right {
        float: right;
        margin-right: 10px;
    }

    @media only screen and (max-width : 768px) {
        .modal-staff-image-wrapper {
            text-align: center;
        }

        .modal-staff-information {
            margin-top: 5px;
        }

        .float-modal-role-right {
            float: unset;
            text-align: center;
            margin-right: 0px;
        }
    }

</style>

<script>

    // User is typing into the field that permits the lookup of staff member accounts.
    function staffSearchKeyUp() {

        if ($("#staff-account-search-query").val().length === 0)
        {
            // Search field is empty:
            $("#staff-account-search-query").removeClass("valid").removeClass("invalid");
        }
        else if (searchQueryIsValid($("#staff-account-search-query").val()))
        {
            // Search input is valid:
            $("#staff-account-search-query").removeClass("invalid").addClass("valid");
        }
        else
        {
            // Search input is invalid:
            $("#staff-account-search-query").removeClass("valid").addClass("invalid");
        }

    }

    // Method to validate that the user is searching for a valid string.
    function searchQueryIsValid(input) {

        return !(input.includes(';'));

    }

    // Method to (try to) locate the value that the user has searched for.
    function searchStaff(valueToFind) {

        console.log("Searching database...");

    }

    // User has clicked on a search result inside the modal.
    function searchResultClicked(element) {

        // Close this modal:
        $('.search-staff-modal').modal('hide');

        // Launch the staff summary modal.
        $('.staff-summary-modal').modal();

        // Pass through relevant data from HTML.
        staffSummaryModalInit(
            $(element).attr('data-id'),
            $(element).attr('data-image'),
            $(element).attr('data-firstName'),
            $(element).attr('data-lastName'),
            $(element).attr('data-email'),
            $(element).attr('data-dob'),
            $(element).attr('data-gender'),
            $(element).attr('data-role')
        );

    }

    // Method used to clear all data from this modal (when this modal is closed).
    function clearSearchStaffModal() {

        //$('.staff-search-results-appended-here').empty();
        $('#staff-account-search-query').val("");
        $('#staff-account-search-query').removeClass('valid').removeClass('invalid');

    }

</script>