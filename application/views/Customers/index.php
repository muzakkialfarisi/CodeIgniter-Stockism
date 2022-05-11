<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Customers</h5>
            </div>
            <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin"){ ?>
                <button type="button" class="btn btn-light btn-pill" data-bs-toggle="modal" data-bs-target="#ModalCreate" id="btn-modal-create">Create New</button>
                <?php $this->load->view("Customers/Create.php") ?>
                <?php $this->load->view("Customers/Edit.php") ?>
            <?php } ?>
        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Id</th>
                        <th>Name</th>
                        <th>Customer Type</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                            <th>Tenant Email</th>
                        <?php } ?>
                        <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin"){ ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($mascustomer as $item) { ?>
                        <tr>
                            <td><?= $item['id_customer'] ?></td>
                            <td><?= $item['name'] ?></td>
                            <td>
                                <?php 
                                $id_customertype = $item['id_customertype'];
                                echo $this->db->query("SELECT * FROM mascustomertype where id_customertype = '$id_customertype'")->row()->name;
                                ?>
                            </td>
                            <td><?= $item['address'] ?></td>
                            <td><?= $item['phone_number'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                                <td><?= $item['email_tenant'] ?></td>
                            <?php } ?>
                            <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin"){ ?>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                            <li><button type="button" class="dropdown-item btn-edit" data-bs-toggle="modal" data-id="<?= $item['id_customer'] ?>" data-bs-target="#ModalEdit">Edit</button></li>
                                            <li><button type="button" class="dropdown-item btn-delete" data-id="<?= $item['id_customer'] ?>">Delete</button></li>
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

<form action="<?= site_url('Customers/DeletePost') ?>" method="post" id="DeletePost">
    <input type="text" class="form-control" name="id_customer" required hidden>
</form>

