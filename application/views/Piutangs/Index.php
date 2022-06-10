<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Utang</h5>
            </div>
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
                        <th>Debt</th>
                        <th>Paid</th>
                        <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                            <th>Tenant</th>
                        <?php } ?>
                        <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin") { ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($maspiutang as $item) { ?>
                        <tr>
                            <td>
                                <?php 
                                    $id_so = $item['id_so'];
                                    echo $this->db->query("SELECT * FROM outsalesorder where id_so = '$id_so'")->row()->invoice_so;
                                ?>
                            </td>
                            <td class="text-center">
                                <?= date_format(date_create($item['date_created']), "d-m-Y") ?>
                            </td>
                            <td class="text-center">
                                <?php if($item['date_due'] != '0000-00-00 00:00:00') { ?>
                                    <?php if($item['date_due'] < date('Y-m-d H:i:s')) { ?>
                                        <span class="text-danger"><?= date_format(date_create($item['date_due']), "d-m-Y") ?></span> <br>
                                        <span class="text-danger text-sm">Late</span>
                                    <?php } else { ?>
                                        <?= date_format(date_create($item['date_due']), "d-m-Y") ?>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                            <td class="text-end"><?= number_format($item['total_piutang']) ?></td>
                            <td class="text-end">
                                <?= number_format($item['sum_payment_price']) ?>
                            </td>
                            <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                                <td><?= $item['email_tenant'] ?></td>
                            <?php } ?>
                            <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin"){ ?>
                                <td class="text-center">
                                    <div class="dropstart">
                                        <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                            <li><a type="button" class="dropdown-item" href="<?= site_url('Piutangs/Detail/'.$item['id_so']) ?>">Details</a></li>
                                            <?php if($item['total_piutang'] >$item['sum_payment_price']) { ?>
                                                <li><button type="button" class="dropdown-item btn-add-payment" data-bs-toggle="modal" data-id="<?= $item['id_so'] ?>" data-bs-target="#ModalAddPayment">Add Payment</button></li>
                                            <?php } ?>
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

<?php $this->load->view("Piutangs/ModalAddPayment.php") ?>