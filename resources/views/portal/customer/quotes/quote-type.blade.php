<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Quote Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="order_type" class="order_type">Quote Type</label>
                <select class="form-control" name="order_type" id="order_type">
                    <option disabled selected>Select Quote Type</option>
                    <option value="dig_order">Digitizing Quote</option>
                    <option value="vector_order">Vector Quote</option>
                    <option value="patches_order">Patches Quote</option>
                    <option value="logo_order">Logo Quote</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" id="order_procceed" class="btn" style="background-color: #29babf; color: white">Proceed</button>
            </div>
        </div>
    </div>
</div>
