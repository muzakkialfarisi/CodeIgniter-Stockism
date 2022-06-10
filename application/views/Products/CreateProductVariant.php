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
                <div class="mb-3 form-group">
                    <label class="control-label">Length (CM)</label>
                    <input type="number" class="form-control vol_weight" name="panjang" value="<?php if (isset($masproduct)) { echo $masproduct->panjang; }?>">
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="mb-3 form-group">
                    <label class="control-label">Width (CM)</label>
                    <input type="number" class="form-control vol_weight" name="lebar" value="<?php if (isset($masproduct)) { echo $masproduct->lebar; }?>">
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="mb-3 form-group">
                    <label class="control-label">Height (CM)</label>
                    <input type="number" class="form-control vol_weight" name="tinggi" value="<?php if (isset($masproduct)) { echo $masproduct->tinggi; }?>">
                </div>
            </div>
        </div>

        <div class="mb-3 form-group">
            <label class="control-label">Actual Weight (Gram)</label>
            <input type="number" class="form-control" name="actual_weight" value="<?php if (isset($masproduct)) { echo $masproduct->actual_weight; }?>">
        </div>

        <div class="mb-3 form-group">
            <label class="control-label">Description</label>
            <textarea class="form-control" rows="3" name="description"></textarea>
        </div>

    </div>
</div>