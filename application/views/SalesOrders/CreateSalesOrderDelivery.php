<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light">Delivery</h5>
    </div>
    <div class="card-body m-3">
        <div class="mb-3 form-group required">
            <label class="control-label">Status</label>
            <select class="form-select flex-grow-1" name="status_delivery">
                <option selected value="Done">Done</option>
                <option value="On Going">On Going</option>
            </select>
        </div>

        <div class="form-group">
            <label class="control-label">Shipping Cost</label>
            <input type="text" class="form-control number-only" name="shipping_cost">
        </div>
        <div class="form-group airway_bill">
            <label class="control-label">Airway Bill</label>
            <input type="text" class="form-control number-only" name="airway_bill" value="0">
        </div>
    </div>
</div>