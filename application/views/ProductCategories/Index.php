<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Product Categories</h5>
            </div>
            <button type="button" class="btn btn-light btn-pill" data-bs-toggle="modal" data-bs-target="#ModalCreate">Create New</button>
        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Name</th>
                        <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                            <th>Tenant</th>
                        <?php } ?>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    foreach($masproductcategory as $item) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $item['name'] ?></td>
                            <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                                <td><?= $item['email_tenant'] ?></td>
                            <?php } ?>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                        <li><button type="button" class="dropdown-item btn-edit" data-bs-toggle="modal" data-id="<?= $item['id_productcategory'] ?>" data-bs-target="#ModalEdit">Edit</button></li>
                                        <li><button type="button" class="dropdown-item btn-delete" data-id="<?= $item['id_productcategory'] ?>">Delete</button></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php
                    $i++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<form action="<?= site_url('ProductCategories/DeletePost') ?>" method="post" id="DeletePost">
    <input type="text" class="form-control" name="id_productcategory" required hidden>
</form>

<?php $this->load->view("ProductCategories/Create.php") ?>
<?php $this->load->view("ProductCategories/Edit.php") ?>