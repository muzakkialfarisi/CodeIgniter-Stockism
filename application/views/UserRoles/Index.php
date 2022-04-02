<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">User Roles</h5>
            </div>

            <button type="button" class="btn btn-light btn-pill" data-bs-toggle="modal" data-bs-target="#Modal">Create New</button>
            <?php $this->load->view("UserRoles/Create.php") ?>

        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($secuserrole as $item) { ?>
                        <tr>
                            <td><?= $item['id_usertype'] ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['description'] ?></td>
                            <td><?= $item['status'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    
    </div>
</div>
