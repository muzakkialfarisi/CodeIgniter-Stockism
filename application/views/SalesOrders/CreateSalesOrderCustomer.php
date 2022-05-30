<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light">Customer</h5>
    </div>
    <div class="card-body m-3">
        <label class="control-label">Name</label>
        <div class="input-group">
            <select class="form-select flex-grow-1" name="id_customer">
                <option selected disabled value="">Select...</option>
            <?php foreach($mascustomer as $item) { ?>}
                <option value="<?= $item['id_customer'] ?>"><?= $item['name'] ?></option>
            <?php } ?>
            </select>
            <a href="<?= site_url('Customers/index') ?>" class="btn bg-stockism text-light" type="button">Add!</a>
        </div>
    </div>
</div>