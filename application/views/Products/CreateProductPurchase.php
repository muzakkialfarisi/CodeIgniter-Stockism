<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Purchase Product</h5>
            </div>
        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="row">
            <?php if (!isset($masproduct)) { ?>
                <div class="col-12 col-sm-6">
                    <div class="mb-3 form-group required">
                        <label class="control-label">First Stock</label>
                        <input type="text" class="form-control number-only" name="quantity" value="0" required>
                    </div>
                </div>
            <?php } ?>

            <div class="col-12 col-sm-6">
                <div class="mb-3 form-group required">
                    <label class="control-label">Purchase Price</label>
                    <input type="text" class="form-control number-only" name="purchase_price" value="<?php if (isset($masproduct)) { echo $masproduct->purchase_price; }?>" <?php if (isset($masproduct)) { echo "readonly"; }?>>
                </div>
            </div>
        </div>
        
        <?php if (!isset($masproduct)) { ?>
            <div class="mb-3 form-group">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="expired_date">
                    <label class="control-label">Expired Date</label>
                </div>
                <div class="input-group date div-expired_date" id="datetimepicker-view-mode" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-view-mode" name="expired_date"/>
                    <div class="input-group-text" data-target="#datetimepicker-view-mode" data-toggle="datetimepicker">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>