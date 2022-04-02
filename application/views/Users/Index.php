<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Users</h5>
            </div>
            <button type="button" class="btn btn-light btn-pill invisible" data-bs-toggle="modal" data-bs-target="#Modal">Create New</button>
        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Email</th>
                        <th>Email Confirmed</th>
                        <th>Status</th>
                        <th>User Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($secuser as $item) { ?>
                        <tr>
                            <td><?= $item['email_user'] ?></td>
                            <td><?= $item['email_confirmed'] ?></td>
                            <td><?= $item['status'] ?></td>
                            <td><?= $item['id_usertype'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    
    </div>
</div>



