<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light">Sales Order</h5>
    </div>
    <div class="card-body m-3">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="mb-3 form-group required">
                    <label class="control-label">Date</label>
                    <input type="datetime-local" class="form-control" name="date_created" required/>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="mb-3 form-group">
                    <label class="control-label">Invoice</label>
                    <input type="text" class="form-control" name="invoice_so" value="<?php if (isset($outsalesorder)) { echo $outsalesorder->invoice_so; }?>">
                </div>
            </div>
        </div>
    </div>
</div>