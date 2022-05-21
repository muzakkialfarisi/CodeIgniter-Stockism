<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Sales Orders</h5>
            </div>
            <a type="button" class="btn btn-light btn-pill" href="<?= site_url('SalesOrders/Create') ?>">Create New</a>
        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>ID Sales Order</th>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Channel</th>
                        <th>Toko</th>
                        <th>Date</th>
                        <th>Total Penjualan</th>
                        <th>Payment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($outsalesorder as $item) { ?>
                        <tr>
                            <td><?= $item['id_so'] ?></td>
                            <td><?= $item['invoice_so'] ?></td>
                            <td>
                                <?php 
                                    $id_supplier = $item['invoice_so'];
                                    echo $this->db->query("SELECT * FROM massupplier where id_marketplace = '$id_supplier'")->row()->name;
                                ?>
                            </td>
                            <td><?= $item['date_created'] ?></td>
                            <td class="text-end">
                                <?php 
                                    $id_po = $item['id_po'];
                                    echo number_format($this->db->query("SELECT SUM(subtotal) AS sum FROM incpurchaseorderproduct where id_po = '$id_po'")->row()->sum);
                                ?>
                            </td>
                            <td><?= $item['payment_status'] ?></td>
                            <td><?= $item['delivery_status'] ?></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                        <li><a type="button" class="dropdown-item" href="<?= site_url('PurchaseOrders/Detail/'.$item['id_po']) ?>">Details</a></li>
                                        <li><button type="button" class="dropdown-item btn-edit" data-bs-toggle="modal" data-id="<?= $item['id_po'] ?>" data-bs-target="#ModalEdit">as</button></li>
                                    </ul>
                                </div>
                            </td>
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