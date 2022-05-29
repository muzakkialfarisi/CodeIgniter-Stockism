<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light">Angsuran</h5>
    </div>
    <div class="card-body m-3">
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Date</th>
                        <th>Payment Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($masutangangsuran->result_array() as $item) { ?>
                        <tr>
                            <td><?= date_format(date_create($item['date_created']), "d-m-Y") ?></td>
                            <td class="text-end"><?= number_format($item['payment_price']) ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm text-danger btn-delete-angsuran" data-id="<?= $item['id_angsuran'] ?>"><i class="align-middle me-2 fas fa-fw fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>