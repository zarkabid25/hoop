<div class="container">
    <div class="card">
        <div class="card-header">
            <h6>Filter</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <label for="order_type">Design Type</label>
                    <select class="form-control" name="order_type" id="order_type">
                        <option disabled selected>Select Order Type</option>
                        <option value="digitizing">Digitizing Order</option>
                        <option value="vector">Vector Order</option>
                        <option value="patches">Patches Order</option>
                        <option value="logo">Logo Order</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                @if(!request()->routeIs('quote.index'))
                    <div class="col-md-5">
                        <label for="order_status">Order Status</label>
                        <select class="form-control" name="order_status" id="order_status">
                            <option selected disabled>Select</option>
                            <option value="0">Pending</option>
                            <option value="1">Approved</option>
                            <option value="2">Cancel</option>
                        </select>
                    </div>
                @endif

                <div class="col-md-2" style="padding-top: 30px">
                    <button class="btn" type="button" id="filter" style="color: white; background-color: #17a2b8">Filter</button>
                    <button class="btn btn-danger" type="button" id="reset">Reset</button>
                </div>
            </div>
        </div>
    </div>
</div>
