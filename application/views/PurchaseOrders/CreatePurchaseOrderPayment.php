<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light">Payment</h5>
    </div>
    <div class="card-body m-3">
        <div class="mb-3 form-group required">
            <label class="control-label">Status</label>
            <select class="form-select flex-grow-1" name="payment_status">
                <?php if (isset($incpurchaseorder)) { ?>
                    <option selected value="<?= $incpurchaseorder->payment_status ?>"><?= $incpurchaseorder->payment_status ?></option>
                <?php } else { ?>
                    <option selected value="Paid">Paid</option>
                    <option value="Debt">Debt</option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3 form-group date_due">
            <label class="control-label">Due Date</label>
            <input type="datetime-local" class="form-control" name="date_due"/>
        </div>
        
        <div class="form-group required date_due">
            <label class="control-label">Down Payment</label>
            <input type="text" class="form-control number-only" name="payment_price" value="<?php if (isset($incpurchaseorder)) { echo $incpurchaseorder->payment_price; }else{ echo 0; } ?>" required <?php if (isset($incpurchaseorder)) { echo "readonly"; } ?>>
        </div>
        
    </div>
</div>