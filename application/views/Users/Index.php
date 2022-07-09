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
                        <!-- <th>Email Confirmed</th> -->
                        <th>Status</th>
                        <th>User Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($secuser as $item) { ?>
                        <tr>
                            <td>
                                <?php 
                                    $email_user = $item['email_user'];
                                    echo $email_user;
                                ?>
                            </td>
                            <!-- <td>
                                <?= $item['email_confirmed'] ?>
                            </td> -->
                            <td>
                                <?php 
                                    $status = $item['status'];
                                    echo $status;
                                    if($status == "active")
                                    {
                                        $result_status = "Deactivate";
                                    }
                                    else
                                    {
                                        $result_status = "Activate";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $id_usertype = $item['id_usertype'];
                                    echo $this->db->query("SELECT * FROM secuserrole where id_usertype = '$id_usertype'")->row()->name;
                                ?>
                            </td>
                            <td class="text-center">
                                <?php if($id_usertype != 1){ ?>
                                    <div class="dropstart">
                                        <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                            <li><a type="button" class="dropdown-item" href="<?= site_url('Users/Activation/'.$email_user.'/'.$status) ?>"><?= $result_status ?></a></li>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    
    </div>
</div>



