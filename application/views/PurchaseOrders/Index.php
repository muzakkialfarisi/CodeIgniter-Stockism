<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Purchase Orders</h5>
            </div>
            <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin"){ ?>
                <a type="button" class="btn btn-light btn-pill" href="<?= site_url('PurchaseOrders/Create') ?>">Create New</a>
            <?php } ?>
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
                            <td><?= $item['invoice_po'] ?></td>
                            <td>
                                <?php 
                                    $id_supplier = $item['id_supplier'];
                                    echo $this->db->query("SELECT * FROM massupplier where id_supplier = '$id_supplier'")->row()->name;
                                ?>
                            </td>
                            <td class="text-center">
                                <?php
                                $date_created = $item['date_created'];
                                echo date("d-m-Y", strtotime($date_created));
                                echo "<br>";
                                echo date("H:i:s", strtotime($date_created));
                                ?>
                            </td>
                            <td class="text-end">
                                <?php 
                                    $id_po = $item['id_po'];
                                    echo number_format($this->db->query("SELECT SUM(subtotal) AS sum FROM incpurchaseorderproduct where id_po = '$id_po'")->row()->sum);
                                ?>
                            </td>
                            <td>
                                <?php if($item['payment_status'] == "Debt") {?>
                                    <span class="text-warning"><?= $item['payment_status'] ?></span>
                                <?php } else { ?>
                                    Done
                                <?php } ?>
                            </td>
                            <td style="min-height:100px">
                                <?php if($item['delivery_status'] == "On Going") { ?>
                                    <?php 
                                        $quantity_accepted   = $this->db->query("SELECT SUM(quantity_accepted) AS quantity_accepted FROM incpurchaseorderproduct where id_po = '$id_po'")->row()->quantity_accepted;
                                        $quantity            = $this->db->query("SELECT SUM(quantity) AS quantity FROM incpurchaseorderproduct where id_po = '$id_po'")->row()->quantity;
                                    ?>
                                    <ul class="list-group text-warning">
                                        <li class="d-flex justify-content-between align-items-center">
                                            OnGoing
                                            <span class="badge bg-danger rounded-pill"><?= $quantity - $quantity_accepted ?></span>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            Done
                                            <span class="badge bg-success rounded-pill"><?= $quantity_accepted ?></span>
                                        </li>
                                    </ul>
                                <?php } else { ?>
                                    <?= $item['delivery_status'] ?>
                                <?php } ?> 
                            </td>
                            <td class="text-center">
                                <div class="dropstart">
                                    <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                        <li><a type="button" class="dropdown-item" href="<?= site_url('PurchaseOrders/Detail/'.$item['id_po']) ?>">Details</a></li>
                                        <?php if($item['delivery_status'] == "On Going") { ?>
                                            <li><a type="button" class="dropdown-item btn-edit-poproduct-quantity" data-bs-toggle="modal" data-bs-target="#ModalEditPurchaseOrderProductQuantity" data-id="<?= $item['id_po'] ?>">Update Delivery</a></li>
                                        <?php } ?>
                                        <?php if($item['payment_status'] == "Debt" || $item['delivery_status'] == "On Going") { ?>
                                            <li><a type="button" class="dropdown-item btn-edit-status" data-bs-toggle="modal" data-bs-target="#ModalEditStatus" data-id="<?= $item['id_po'] ?>">Change Status</a></li>
                                        <?php } ?>
                                        <li><button type="button" class="dropdown-item text-danger btn-delete" data-id="<?= $item['id_po'] ?>">Cancel Transaction</button></li>
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

<form action="<?= site_url('PurchaseOrders/DeletePost') ?>" method="post" id="DeletePost">
    <input type="text" class="form-control" name="id_po" required hidden>
</form>

<?php $this->load->view("PurchaseOrders/ModalEditPurchaseOrderProductQuantity.php") ?>
<?php $this->load->view("PurchaseOrders/ModalEditStatus.php") ?>