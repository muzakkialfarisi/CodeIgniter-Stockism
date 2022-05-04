<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Stores</h5>
            </div>
            <button type="button" class="btn btn-light btn-pill" data-bs-toggle="modal" data-bs-target="#ModalCreate">Create New</button>
        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Komisi</th>
                        <th>Marketplace</th>
                        <th>Email Tenant</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($mastoko as $item) { ?>
                        <tr>
                            <td class="text-center">
                                <img src="<?= base_url(); ?>assets/img/stores/<?=$item['photo'] ?>" class="rounded-circle" height="60" width="60" asp-append-version="true"/>
                            </td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['phone_number'] ?></td>
                            <td><?= $item['komisi'] ?> %</td>
                            <?php   if ($item['id_marketplace'] == 1) { ?>
                                <td>Tokopedia</td>
                            <?php } if ($item['id_marketplace'] == 2) { ?>
                                <td>Bukalapak</td>
                            <?php } ?>
                            <td><?= $item['email_tenant'] ?></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                        <li><button type="button" class="dropdown-item btn-edit" data-bs-toggle="modal" data-id="<?= $item['id_toko'] ?>" data-bs-target="#ModalEdit">Edit</button></li>
                                        <li><button type="button" class="dropdown-item btn-delete" data-id="<?= $item['id_toko'] ?>">Delete</button></li>
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

<form action="<?= site_url('Stores/DeletePost') ?>" method="post" id="DeletePost">
    <input type="text" class="form-control" name="id_toko" required hidden>
</form>

<?php $this->load->view("Stores/Create.php") ?>
<?php $this->load->view("Stores/Edit.php") ?>


