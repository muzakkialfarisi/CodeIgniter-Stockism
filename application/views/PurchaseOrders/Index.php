<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Product Units</h5>
            </div>
            <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin") { ?>
                <button type="button" class="btn btn-light btn-pill" id="btn-modal-create" data-bs-toggle="modal" data-bs-target="#ModalCreate">Create New</button>
                <!-- <?php $this->load->view("ProductUnits/Create.php") ?>
                <?php $this->load->view("ProductUnits/Edit.php") ?> -->
            <?php } ?>
        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Invoice</th>
                        <th>Created</th>
                        <th>Date Due</th>
                        <th>Terhutang</th>
                        <th>Terbayar</th>
                        <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                            <th>Tenant</th>
                        <?php } ?>
                        <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin") { ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($masutang as $item) { ?>
                        <tr>
                            <td>
                                <?php 
                                    $id_po = $item['id_po'];
                                    echo $this->db->query("SELECT * FROM incpurchaseorder where id_po = '$id_po'")->row()->invoice_po;
                                ?>
                            </td>
                            <td class="text-center">
                                <?= date_format(date_create($item['date_created']), "d-m-Y") ?>
                            </td>
                            <td class="text-center">
                                <?php if($item['date_due'] != '0000-00-00 00:00:00') { ?>
                                    <?php if($item['date_due'] > date('Y-m-d H:i:s')) { ?>
                                        <span class="text-danger"><?= date_format(date_create($item['date_due']), "d-m-Y") ?></span> <br>
                                        <span class="text-danger text-sm">Terlambat</span>
                                    <?php } else { ?>
                                        <?= date_format(date_create($item['date_due']), "d-m-Y") ?>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                            <td class="text-end"><?= number_format($item['total_utang']) ?></td>
                            <td class="text-end">
                                <?= number_format($item['sum_payment_price']) ?>
                            </td>
                            <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                                <td><?= $item['email_tenant'] ?></td>
                            <?php } ?>
                            <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin"){ ?>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                            <li><button type="button" class="dropdown-item btn-delete" data-id="<?= $item['id_po'] ?>">Details</button></li>
                                            <li><button type="button" class="dropdown-item btn-add-payment" data-bs-toggle="modal" data-id="<?= $item['id_po'] ?>" data-bs-target="#ModalAddPayment">Add Payment</button></li>
                                        </ul>
                                    </div>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<form action="<?= site_url('ProductUnits/DeletePost') ?>" method="post" id="DeletePost">
    <input type="text" class="form-control" name="id_productunit" required hidden>
</form>

<?php $this->load->view("Utangs/ModalAddPayment.php") ?>