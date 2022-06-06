<h4 class="tab-title mb-5">Purchase Order Histories</h4>
<div class="table-responsive" style="width:100%">
    <table class="table table-striped" style="width:100%">
        <thead>
            <tr class="text-center">
                <th>Date</th>
                <th>Batch SKU</th>
                <th>Exp. Date</th>
                <th>Stock</th>
                <th>Purchase Price</th>
                <th>Storage</th>
                <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin"){ ?>
                    <th>Action</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            foreach($incpurchaseorderproduct as $item) { ?>
                <tr>
                    <td><?= date_format(date_create($item['date_created']), "d-m-Y") ?></td>
                    <td><?= $item['sku'] ?></td>
                    <td><?php if($item['expired_date'] != '0000-00-00 00:00:00') { echo date_format(date_create($item['expired_date']), "d-m-Y"); } ?></td>
                    <td><?= $item['quantity_accepted'] ?></td>
                    <td class="text-end"><?= number_format($item['purchase_price']) ?></td>
                    <td><?= $item['storage'] ?></td>
                    <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin"){ ?>
                        <td class="text-center">
                            <button class="btn btn-sm text-primary btn-edit-purchaseorderproduct" data-id="<?= $item['id_poproduct'] ?>" data-bs-toggle="modal" data-bs-target="#ModalEditPurchaseOrderProduct"><i class="align-middle me-2 fas fa-fw fa-edit"></i></button>
                        </td> 
                    <?php } ?>
                </tr>
            <?php
            $i++; } ?>
        </tbody>
    </table>
</div>