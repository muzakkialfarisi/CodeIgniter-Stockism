<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light">Payment</h5>
    </div>
    <div class="card-body m-3">
        <div class="mb-3 form-group required">
            <label class="control-label">Status</label>
            <select class="form-select flex-grow-1" name="payment_status">
                <option selected value="Paid">Paid</option>
                <option value="Debt">Debt</option>
            </select>
        </div>

        <div class="form-group date_due">
            <label class="control-label">Due Date</label>
            <div class="input-group date" id="datetimepicker-view-mode" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-view-mode" name="date_due"/>
                <div class="input-group-text" data-target="#datetimepicker-view-mode" data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
</div>