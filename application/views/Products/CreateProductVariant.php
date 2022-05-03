<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Product Variant</h5>
            </div>
        </div>
    </div>
    <div class="card-body m-3">
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="mb-3 form-group required">
                    <label class="control-label">Panjang (CM)</label>
                    <input type="number" class="form-control vol_weight" name="panjang" value="<?php if (isset($masproduct)) { echo $masproduct->panjang; }?>" required>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="mb-3 form-group required">
                    <label class="control-label">Lebar (CM)</label>
                    <input type="number" class="form-control vol_weight" name="lebar" value="<?php if (isset($masproduct)) { echo $masproduct->lebar; }?>" required>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="mb-3 form-group required">
                    <label class="control-label">Tinggi (CM)</label>
                    <input type="number" class="form-control vol_weight" name="tinggi" value="<?php if (isset($masproduct)) { echo $masproduct->tinggi; }?>" required>
                </div>
            </div>
        </div>

        <div class="mb-3 form-group required">
            <label class="control-label">VolWeight (Gram)</label>
            <input type="number" class="form-control" name="vol_weight" value="<?php if (isset($masproduct)) { echo $masproduct->vol_weight; }?>" readonly>
        </div>

        <div class="mb-3 form-group required">
            <label class="control-label">ActualWeight (Gram)</label>
            <input type="number" class="form-control" name="actual_weight" value="<?php if (isset($masproduct)) { echo $masproduct->actual_weight; }?>" required>
        </div>

        <div class="mb-3 form-group required">
            <label class="control-label">Description</label>
            <textarea class="form-control" rows="3" name="description" required></textarea>
        </div>

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
    </div>
</div>