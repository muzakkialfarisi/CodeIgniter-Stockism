<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light">Sales Channel</h5>
    </div>
    <div class="card-body m-3">
        <div class="mb-3 form-group required">
            <label class="control-label">Marketplace</label>
            <select class="form-select" name="id_marketplace" required>
                <option selected disabled value="">Select...</option>
                <?php foreach ($masmarketplace as $item) { ?>
                    <option value="<?= $item["id_marketplace"] ?>"><?= $item["name"] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3 form-group toko required">
            <label class="control-label">Store</label>
            <select class="form-select" name="id_toko" required>
                <option selected disabled value="">Select...</option>
                
            </select>
        </div>

        <div class="form-group tax_cost">
            <label class="control-label">Tax Cost</label>
            <input type="text" class="form-control number-only" name="tax_cost" value="" readonly>
        </div>
    </div>
</div>