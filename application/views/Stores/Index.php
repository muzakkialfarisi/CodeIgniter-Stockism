<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Stores</h5>
            </div>
            <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin"){ ?>
                <button type="button" class="btn btn-light btn-pill" data-bs-toggle="modal" data-bs-target="#ModalCreate" id="btn-modal-create">Create New</button>
            <?php } ?>
        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Commission</th>
                        <th>Marketplace</th>
                        <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                            <th>Email Tenant</th>
                        <?php } ?>
                        <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin"){ ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($mastoko as $item) { ?>
                        <tr>
                            <td class="text-center">
                                <img src="<?= base_url(); ?>assets/img/stores/<?=$item['picture'] ?>" class="rounded-circle" height="60" width="60" asp-append-version="true"/>
                            </td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['phone_number'] ?></td>
                            <td><?= $item['komisi'] ?> %</td>
                            <td>
                                <?php 
                                    $id_marketplace = $item['id_marketplace'];
                                    $marketplace = $this->db->query("SELECT * FROM masmarketplace where id_marketplace = '$id_marketplace'")->row()->name;
                                    echo $marketplace;
                                ?>
                            </td>
                            <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                                <td><?= $item['email_tenant'] ?></td>
                            <?php } ?>
                            <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin"){ ?>
                                <td class="text-center">
                                    <div class="dropstart">
                                        <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                            <li><button type="button" class="dropdown-item btn-edit" data-bs-toggle="modal" data-id="<?= $item['id_toko'] ?>" data-bs-target="#ModalEdit">Edit</button></li>
                                            <li><button type="button" class="dropdown-item btn-delete" data-id="<?= $item['id_toko'] ?>">Delete</button></li>
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

<form action="<?= site_url('Stores/DeletePost') ?>" method="post" id="DeletePost">
    <input type="text" class="form-control" name="id_toko" required hidden>
</form>

<?php $this->load->view("Stores/Create.php") ?>
<?php $this->load->view("Stores/Edit.php") ?>


