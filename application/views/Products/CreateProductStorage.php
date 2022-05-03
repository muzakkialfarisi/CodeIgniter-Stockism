<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Product Storage</h5>
            </div>
        </div>
    </div>
    <div class="card-body m-3">
        <div class="mb-3 form-group">
            <label class="control-label">Minimum Stock</label>
            <input type="number" class="form-control number-only" name="minimum_stock" value="<?php if (isset($masproduct)) { echo $masproduct->minimum_stock; }else{ echo 0; }?>">
        </div>
        <?php if (!isset($masproduct)) { ?>
            <div class="mb-3 form-group">
                <label class="control-label">Storage</label>
                <input type="text" class="form-control" name="storage">
            </div>
        <?php } ?>
    </div>
</div>