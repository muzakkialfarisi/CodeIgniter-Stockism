<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light">Details</h5>
    </div>
    <div class="card-body m-3">
        <div class="mb-3 form-group required">
            <label class="control-label">Supplier</label>
            <select class="form-select" name="id_supplier" required>
                <option selected disabled value="">Select...</option>
                <?php foreach ($massupplier as $item) { ?>
                    <option value="<?= $item["id_supplier"] ?>"><?= $item["name"] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label class="control-label">Tax Cost</label>
            <input type="text" class="form-control number-only" name="tax_cost">
        </div>
    </div>
</div>