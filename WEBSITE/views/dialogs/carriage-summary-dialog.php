<div class="modal fade carriage-summary-modal" id="carriage-summary-modal" tabindex="-1" role="dialog" aria-labelledby="carriage-summary-modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carriage-name">
                    <!-- modal title is appended here -->
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white; box-shadow: unset !important;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button id="cancel-create-train-button" type="button" class="modal-btn create-button" data-dismiss="modal">Cancel</button>
                <button type="button" class="modal-btn create-button" onclick="updateCarriageData()">Save</button>-->
            </div>
        </div>
    </div>
</div>

<style>



</style>

<script>

    let carriageId;
    let trainId;
    let trainName;
    let classification;
    let numberOfSeats;
    let carriageName;

    // Method to populate the modal with data regarding the train carriage in question.
    function carriageSummaryModalInit(idInit, trainIdInit, trainNameInit, classificationInit, numberOfSeatsInit, carriageNameInit) {

        // Set required fields.
        carriageId      = idInit;
        trainId         = trainIdInit;
        trainName       = trainNameInit;
        classification  = classificationInit;
        numberOfSeats   = numberOfSeatsInit;
        carriageName    = carriageNameInit;

        // Push data into the modal content.
        $('#carriage-name').text(carriageNameInit);

    }

    // Method called to allow the admin to make their proposed changes to the train carriage in question.
    function updateCarriageData() {



    }

    // Method called when this modal is closed.
    function clearCarriageSummaryDataModal() {

        // Reset fields.
        carriageId      = undefined;
        trainId         = undefined;
        trainName       = undefined;
        classification  = undefined;
        numberOfSeats   = undefined;
        carriageName    = undefined;

    }

</script>