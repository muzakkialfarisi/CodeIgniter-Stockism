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
                        <th>Status Payment</th>
                        <th>Status Delivery</th>
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
                                    $id_customer = $item['id_customer'];
                                    echo $this->db->query("SELECT * FROM mascustomer where id_customer = '$id_customer'")->row()->name;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $id_marketplace = $item['id_marketplace'];
                                    echo $this->db->query("SELECT * FROM masmarketplace where id_marketplace = '$id_marketplace'")->row()->name;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $id_toko = $item['id_toko'];
                                    echo $this->db->query("SELECT * FROM mastoko where id_toko = '$id_toko'")->row()->name;
                                ?>
                            </td>
                            <td><?= $item['date_created'] ?></td>
                            <td class="text-end">
                                <?php 
                                    $id_so = $item['id_so'];
                                    echo number_format($this->db->query("SELECT SUM(subtotal) AS sum FROM outsalesorderproduct where id_so = '$id_so'")->row()->sum);
                                ?>
                            </td>
                            <td><?= $item['status_payment'] ?></td>
                            <td><?= $item['status_delivery'] ?></td>
                            <td class="text-center">
                                <div class="dropstart">
                                    <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                        <li><a type="button" class="dropdown-item" href="<?= site_url('SalesOrders/Detail/'.$item['id_so']) ?>">Details</a></li>
                                        <?php if($item['status_delivery'] == "On Going") { ?>
                                            <li><a type="button" class="dropdown-item btn-edit-poproduct-quantity" data-bs-toggle="modal" data-bs-target="#ModalEditSalesOrderProductQuantity" data-id="<?= $item['id_so'] ?>">Update Delivery</a></li>
                                        <?php } ?>
                                        <?php if($item['status_payment'] == "Debt" || $item['status_delivery'] == "On Going") { ?>
                                            <li><a type="button" class="dropdown-item btn-edit-status" data-bs-toggle="modal" data-bs-target="#ModalEditStatus" data-id="<?= $item['id_so'] ?>">Change Status</a></li>
                                        <?php } ?>
                                        <li><button type="button" class="dropdown-item text-danger btn-delete" data-id="<?= $item['id_so'] ?>">Cancel Transaction</button></li>
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

<?php $this->load->view("SalesOrders/ModalEditStatus.php") ?>