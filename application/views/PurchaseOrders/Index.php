<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Purchase Orders</h5>
            </div>
            <a type="button" class="btn btn-light btn-pill" href="<?= site_url('PurchaseOrders/Create') ?>">Create New</a>
        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Invoice</th>
                        <th>Supplier</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Delivery</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($incpurchaseorder as $item) { ?>
                        <tr>
                            <!-- <td><?= $item['invoice_po'] ?></td>
                            <td><?= $item['supplier'] ?></td>
                            <td><?= $item['invoice_po'] ?></td>
                            <td><?= $item['supplier'] ?></td>
                            <td><?= $item['invoice_po'] ?></td>
                            <td><?= $item['supplier'] ?></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                        <li><button type="button" class="dropdown-item btn-edit" data-bs-toggle="modal" data-id="<?= $item['id_productcategory'] ?>" data-bs-target="#ModalEdit">Edit</button></li>
                                        <li><button type="button" class="dropdown-item btn-delete" data-id="<?= $item['id_productcategory'] ?>">Delete</button></li>
                                    </ul>
                                </div>
                            </td> -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<form action="<?= site_url('ProductCategories/DeletePost') ?>" method="post" id="DeletePost">
    <input type="text" class="form-control" name="id_productcategory" required hidden>
</form>