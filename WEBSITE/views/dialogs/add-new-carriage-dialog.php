<div class="modal fade add-new-carriage-modal" id="add-new-carriage-modal" tabindex="-1" role="dialog" aria-labelledby="add-new-carriage-modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new carriage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white; box-shadow: unset !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- select train -->
                            <h6 class="modal-sub-header">Select Train:</h6>
                            <select class="modal-select-value form-control" id="select-train">

                                <?php

                                $result = file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/trains');
                                $data = json_decode($result, true);

                                for ($i = 0; $i < sizeof($data); $i++)
                                {
                                    $company = json_decode(file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_companies/' . $data[$i]['TRAIN_COMPANY_ID']), true);

                                    echo '<option class="select-train-option" value="' . $data[$i]['ID'] . '"
                                            >' . $company['COMPANY_NAME'] . ", " .  $data[$i]['TRAIN_TYPE'] . ", " . $data[$i]['ID'] . '</option>';
                                }

                                ?>

                            </select>

                            <!-- select carriage classification -->
                            <h6 class="modal-sub-header" style="margin-top: 10px">Select Carriage Type:</h6>
                            <select class="modal-select-value form-control" id="select-class">
                                <option class="select-class-option" value="Passenger">Passenger</option>
                                <option class="select-class-option" value="Freight">Freight</option>
                            </select>

                            <!-- input number of seats -->
                            <h6 class="modal-sub-header" style="margin-top: 10px">Number of Seats / Units:</h6>
                            <input onkeyup="seatCountKeyUp(this)" type="text" name="no-of-seats" id="no-of-seats" class="modal-field" placeholder="Number of seats"
                            style="margin-top: 0px !important;"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="cancel-create-train-button" type="button" class="modal-btn create-button" data-dismiss="modal">Cancel</button>
                <button type="button" class="modal-btn create-button" onclick="addNewCarriage()">Add</button>
            </div>
        </div>
    </div>
</div>

<style>



</style>

<script>

    let seatCountValid;

    // Method called when the modal is initialised.
    function addCarriageModalInit() {

        seatCountValid  = false;

    }

    // Admin is typing into the field which holds data about the number of seats for the new carriage.
    function seatCountKeyUp(element) {

        if ($(element).val().trim().length === 0)
        {
            $(element).removeClass('valid').removeClass('invalid');
            seatCountValid = false;
        }
        else if ($(element).val().trim().length > 0 && isNumerical($(element).val().trim()) && !($(element).val().includes(';')))
        {
            $(element).addClass('valid').removeClass('invalid');
            seatCountValid = true;
        }
        else
        {
            $(element).addClass('invalid').removeClass('valid');
            seatCountValid = false;
        }

    }

    // Method to determine if an input is numerical or not.
    function isNumerical(value) {

        return /^\+?(0|[1-9]\d*)$/.test(value);

    }

    // Method to allow the admin to add a new carriage to the system records.
    function addNewCarriage() {

        if (seatCountValid)
        {
            $.ajax({
                url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/carriages",
                type: 'POST',
                data: {
                    CARRIAGE_CLASSIFICATION: $('#select-class').val(),
                    FREIGHT_COMPANY_ID: null,
                    TOTAL_NUMBER_OF_SEATS: $('#no-of-seats').val(),
                    NUMBER_OF_AVAILABLE_SEATS: $('#no-of-seats').val()
                },
                success: function() {

                    // $.ajax({
                    //     url: "http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/train_carriages",
                    //     type: 'POST',
                    //     data: {
                    //         TRAIN_ID: $('#select-train-company').val(),
                    //         CARRIAGE_ID: $('#select-train-type').val()
                    //     },
                    //     success: function () {
                            // Close this modal.
                            $('.add-new-carriage-modal').modal('hide');

                            // Inform the user that the train has been added successfully.
                            Swal.fire({
                                position: 'top',
                                type: 'success',
                                title: 'New carriage has been added!',
                                showConfirmButton: false,
                                timer: 2000
                            });

                            setTimeout(function () {
                                location.reload();
                            }, 2000)
                        // }
                    // });
                },
                error: function () {

                    // Do something...
                    // Inform the user that their request could not be completed?

                }
            });
        }

    }

    // Method called on close of this modal to reset the inputs.
    function clearAddCarriageModal() {

        // Reset variable(s).
        seatCountValid = undefined;

        // Reset input(s).
        $('#no-of-seats').val("");
        $('#no-of-seats').removeClass('invalid').removeClass('valid');

    }

</script>