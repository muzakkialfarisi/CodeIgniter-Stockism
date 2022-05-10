<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light">New Purchase Order</h5>
    </div>
    <div class="card-body m-3">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="mb-3 form-group required">
                    <label class="control-label">Date</label>
                    <div class="input-group date" id="datetimepicker-view-mode" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-view-mode" name="date_created" required/>
                        <div class="input-group-text" data-target="#datetimepicker-view-mode" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="mb-3 form-group">
                    <label class="control-label">Invoice</label>
                    <input type="text" class="form-control number-only" name="invoice_po">
                </div>
            </div>
        </div>
    </div>
</div>