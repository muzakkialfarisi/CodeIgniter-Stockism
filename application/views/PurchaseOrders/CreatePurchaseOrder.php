<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light">New Purchase Order</h5>
    </div>
    <div class="card-body m-3">
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="mb-3 form-group required">
                    <label class="control-label">Warehouse</label>
                    <select class="form-control mb-3" name="id_warehouse" required>
                        <option selected disabled>Select...</option>
                        <?php foreach($maswarehouse as $item) { ?>
                            <option value="<?= $item['id_warehouse'] ?>"><?= $item['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="mb-3 form-group required">
                    <label class="control-label">Date</label>
                    <input type="datetime-local" class="form-control" name="date_created" required value="<?= date("Y-m-d"); ?>"/>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="mb-3 form-group">
                    <label class="control-label">Invoice</label>
                    <input type="text" class="form-control number-only" name="invoice_po">
                </div>
            </div>
        </div>
    </div>
</div>