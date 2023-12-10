<div class="modal fade add-new-train-modal" id="add-new-train-modal" tabindex="-1" role="dialog" aria-labelledby="add-new-train-modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new train</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white; box-shadow: unset !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <!-- select train company -->
                            <h6 class="modal-sub-header">Train Company:</h6>
                            <select class="modal-select-value form-control" id="select-train-company">
                                <?php

                                    $result = file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_companies');
                                    $data = json_decode($result, true);

                                    for ($i = 0; $i < sizeof($data); $i++)
                                    {
                                        echo '<option class="select-company-option" value="' . $data[$i]['ID'] . '">' . $data[$i]['COMPANY_NAME'] . '</option>';
                                    }


                                ?>
                            </select>

                            <!-- select train type -->
                            <h6 class="modal-sub-header">Train Type:</h6>
                            <select class="modal-select-value form-control" id="select-train-type">
                                <option class="select-train-option" value="Diesel">Diesel</option>
                                <option class="select-train-option" value="Electric">Electric</option>
                                <option class="select-train-option" value="Combined">Combined</option>
                                <option class="select-train-option" value="Steam">Steam</option>
                            </select>

                            <!-- select load -->
                            <h6 class="modal-sub-header">Cargo Type:</h6>
                            <select class="modal-select-value form-control" id="select-train-load">
                                <option class="select-train-option" value="Passenger">Passenger</option>
                                <option class="select-train-option" value="Freight">Freight</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="cancel-create-train-button" type="button" class="modal-btn create-button" data-dismiss="modal">Cancel</button>
                <button type="button" class="modal-btn create-button" onclick="addNewTrain()">Create</button>
            </div>
        </div>
    </div>
</div>

<style>

#select-train-company,
#select-train-type,
#select-train-load,
#select-class,
#select-train,
#select-departure-location,
#select-arrival-location {
    margin-top: 5px;
    margin-bottom: 5px;

    color: #333;

    font-family: 'Raleway', arial;
}

</style>

<script>

    // Method to add a new train to the server:
    function addNewTrain() {

        $.ajax({
            url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/trains",
            type: 'POST',
            data: {
                TRAIN_COMPANY_ID: $('#select-train-company').val(),
                TRAIN_TYPE: $('#select-train-type').val(),
                CARGO_TYPE: $('#select-train-load').val()
            },
            success: function() {

                // Close the modal:
                $('#cancel-create-train-button').click();

                // Inform the user that the train has been added successfully.
                Swal.fire({
                    position: 'top',
                    type: 'success',
                    title: 'New train has been created!',
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

</script>