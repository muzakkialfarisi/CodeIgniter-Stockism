<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Supplier</h5>
            </div>
            <button type="button" class="btn btn-light btn-pill" data-bs-toggle="modal" data-bs-target="#ModalCreate" id="btn-modal-create">Create New</button>
        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Id</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Email Tenant</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($massupplier as $item) { ?>
                        <tr>
                            <td><?= $item['id_supplier'] ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['address'] ?></td>
                            <td><?= $item['phone_number'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <td><?= $item['email_tenant'] ?></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                        <li><button type="button" class="dropdown-item btn-edit" data-bs-toggle="modal" data-id="<?= $item['id_supplier'] ?>" data-bs-target="#ModalEdit">Edit</button></li>
                                        <li><button type="button" class="dropdown-item btn-delete" data-id="<?= $item['id_supplier'] ?>">Delete</button></li>
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

<form action="<?= site_url('Suppliers/DeletePost') ?>" method="post" id="DeletePost">
    <input type="text" class="form-control" name="id_supplier" required hidden>
</form>

<?php $this->load->view("Suppliers/Create.php") ?>
<?php $this->load->view("Suppliers/Edit.php") ?>