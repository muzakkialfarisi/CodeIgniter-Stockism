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
                    <?php 
                    $i = 1;
                    foreach($masutang as $item) { ?>
                        <tr>
                            <td><?= $item['id_po'] ?></td>
                            <td><?= $item['total_utang'] ?></td>
                            <td><?= $item['total_bayar'] ?></td>
                            <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                                <td><?= $item['email_tenant'] ?></td>
                            <?php } ?>
                            <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin"){ ?>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                            <li><button type="button" class="dropdown-item btn-edit" data-bs-toggle="modal" data-id="<?= $item['id_utang'] ?>" data-bs-target="#ModalEdit">Edit</button></li>
                                            <li><button type="button" class="dropdown-item btn-delete" data-id="<?= $item['id_utang'] ?>">Delete</button></li>
                                        </ul>
                                    </div>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php
                    $i++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<form action="<?= site_url('ProductUnits/DeletePost') ?>" method="post" id="DeletePost">
    <input type="text" class="form-control" name="id_productunit" required hidden>
</form>