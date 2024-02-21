<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <label for="order_type">Order Type</label>
                <select class="form-control mb-3" name="order_type" id="order_type">
                    <option disabled selected>Select Order Type</option>
                    <option value="dig_order">Digitizing Order</option>
                    <option value="vector_order">Vector Order</option>
                    <option value="patches_order">Patches Order</option>
                    <option value="logo_order">Logo Order</option>
                    <option value="other">Other</option>
                </select>

                <input type="text" name="ord_type" class="form-control" id="ord_type" style="display: none" placeholder="Enter Order Type" />
            </div>
            <div class="modal-footer">
                <button type="button" id="order_procceed" class="btn" style="background-color: #29babf; color: white">Proceed to Order</button>
            </div>
        </div>
    </div>
</div>
