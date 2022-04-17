<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Product Code</h5>
            </div>
        </div>
    </div>
    <div class="card-body m-3">
        <small class="form-text d-block text-mute mb-3">System will generate SKU adn QRCode automatically if you don't have code.</small>

        <div class="mb-3 form-group required">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="sku">
            <label class="control-label">SKU</label>
            </div>
            <input type="text" class="form-control" name="sku" required value="Auto Generated" readonly>
        </div>

        <div class="mb-3 form-group required">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="code">
                <label class="control-label">QRCode</label>
            </div>
            <input type="text" class="form-control" name="code" required value="Auto Generated" readonly>
        </div>
    </div>
</div>