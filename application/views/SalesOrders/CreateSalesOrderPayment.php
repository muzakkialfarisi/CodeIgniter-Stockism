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
            <div class="mb-3 form-group required">
                <label class="control-label">Date</label>
                <input type="datetime-local" class="form-control" name="date_created" required value="<?= date("Y-m-d"); ?>"/>
            </div>
        </div>
    </div>
</div>