<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light">Details</h5>
    </div>
    <div class="card-body m-3">
        <div class="mb-3 form-group required">
            <label class="control-label">Supplier</label>
            <select class="form-select" name="id_supplier" required>
                <?php if (isset($incpurchaseorder)) { ?>
                    <option selected value="<?= $massupplierid->id_supplier ?>"><?= $massupplierid->name ?></option>
                <?php } else { ?>
                    <option selected disabled>Select...</option>
                <?php } ?>
                <?php foreach($massupplier as $item) { ?>
                    <option value="<?= $item['id_supplier'] ?>"><?= $item['name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group required">
            <label class="control-label">Tax Cost</label>
            <input type="text" class="form-control number-only" name="tax_cost" value="<?php if (isset($incpurchaseorder)) { echo $incpurchaseorder->tax_cost; } else { echo 0; }?>" required <?php if (isset($incpurchaseorder)) { echo "readonly"; }?>>
        </div>
    </div>
</div>