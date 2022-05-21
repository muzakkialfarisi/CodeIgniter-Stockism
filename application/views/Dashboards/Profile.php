<div class="row">
	<div class="col-md-3 col-xl-2">

		<div class="card">
			<div class="card-header">
				<h5 class="card-title mb-0">Profile Settings</h5>
			</div>

			<div class="list-group list-group-flush" role="tablist">
				<a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
					Account
				</a>
				<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
					Password
				</a>
			</div>
		</div>
	</div>
	
	<div class="col-md-9 col-xl-10">
		<div class="tab-content">
			<div class="tab-pane fade show active" id="account" role="tabpanel">

				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Account</h5>
					</div>
					<div class="card-body">
						<form action="<?= site_url('Dashboards/ProfileAccount') ?>" method="post">
							<?php { 
								$email = $this->session->userdata['logged_in']['email'];

								if($this->session->userdata['logged_in']['id_usertype'] == "Tenant") { 
                                    $account = $this->db->query("SELECT * FROM mastenant where email = '$email'")->row();
                                }
                                else{
                                    $account = $this->db->query("SELECT * FROM masemployee where email = '$email'")->row();
                                }

							?>
							<div class="row">
								<div class="col-md-8">
									<div class="mb-3 form-group required">
										<label class="control-label">Email</label>
										<input type="email" class="form-control" name="email" value="<?= $email ?>" readonly required>
									</div>
									<div class="row">
										<div class="col-12 col-sm-6">
											<div class="mb-3 form-group required">
												<label class="control-label">Name</label>
												<input type="text" class="form-control" name="name" value="<?= $account->name; ?>" required>
											</div>
										</div>
										<div class="col-12 col-sm-6">
											<div class="mb-3 form-group required">
												<label class="control-label">Whatsapp Number</label>
												<input type="text" class="form-control" name="phone_number" value="<?= $account->phone_number; ?>" required>
											</div>
										</div>
									</div>
									<div class="mb-3">
										<label>Address</label>
										<input type="text" class="form-control" name="address" value="<?= $account->address; ?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="text-center">
										<img src="<?= base_url(); ?>assets/img/tenant/<?= $account->picture; ?>" class="img-thumbnail picture_preview" width="128" height="128" asp-append-version="true"/>
										<div class="mt-2">
											<input type="file" class="form-control" name="picture">
										</div>
										<small>Max 1 MB</small>
									</div>
								</div>
							</div>
						
							<button type="submit" class="btn bg-stockism text-light btn-pill">Save</button>
							<?php } ?>
						</form>

					</div>
				</div>

			</div>

			
			<div class="tab-pane fade" id="password" role="tabpanel">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Password</h5>

						<form action="<?= site_url('Dashboards/ProfilePassword') ?>" method="post">
							<div class="mb-3">
								<label for="inputPasswordCurrent">Current password</label>
								<input type="password" class="form-control" id="inputPasswordCurrent">
								<small><a href="#">Forgot your password?</a></small>
							</div>
							<div class="mb-3">
								<label for="inputPasswordNew">New password</label>
								<input type="password" class="form-control" id="inputPasswordNew">
							</div>
							<div class="mb-3">
								<label for="inputPasswordNew2">Verify password</label>
								<input type="password" class="form-control" id="inputPasswordNew2">
							</div>
							<button type="submit" class="btn bg-stockism text-light btn-pill">Save</button>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>


