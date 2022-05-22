<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Employees</h5>
            </div>
            <button type="button" class="btn btn-light btn-pill" data-bs-toggle="modal" data-bs-target="#ModalCreate" id="btn-modal-create">Create New</button>
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
                        <th>Address</th>
                        <th>Email</th>
                        <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                            <th>Tenant</th>
                        <?php } ?>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($masemployees as $item) { ?>
                        <tr>
                            <td class="text-center">
                                <img src="<?= base_url(); ?>assets/img/avatars/<?=$item['picture'] ?>" class="rounded-circle" height="60" width="60" asp-append-version="true"/>
                            </td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['phone_number'] ?></td>
                            <td><?= $item['address'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                                <td><?= $item['email_tenant'] ?></td>
                            <?php } ?>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                        <li><button type="button" class="dropdown-item btn-edit" data-bs-toggle="modal" data-id="<?= $item['id_employee'] ?>" data-bs-target="#ModalEdit">Edit</button></li>
                                        <li><button type="button" class="dropdown-item btn-delete" data-id="<?= $item['id_employee'] ?>">Delete</button></li>
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


<form action="<?= site_url('Employees/DeletePost') ?>" method="post" id="DeletePost">
    <input type="text" class="form-control" name="id_employee" required hidden>
    <input type="text" class="form-control" name="email" required hidden>
</form>

<?php $this->load->view("Employees/Create.php") ?>
<?php $this->load->view("Employees/Edit.php") ?>