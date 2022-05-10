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
						<h5 class="card-title mb-0">Public info</h5>
					</div>
					<div class="card-body">
						<form>
							<div class="row">
								<div class="col-md-8">
									<div class="mb-3 form-group required">
										<label class="control-label">Email</label>
										<input type="text" class="form-control" value="<?= $this->session->userdata['logged_in']['email_user'] ?>" readonly required>
									</div>
									<div class="row">
										<div class="col-12 col-sm-6">
											<div class="mb-3">
												<label>Name</label>
												<input type="text" class="form-control" value="<?= $this->session->userdata['logged_in']['name'] ?>" required>
											</div>
										</div>
										<div class="col-12 col-sm-6">
											<div class="mb-3">
												<label>Whatsapp Number</label>
												<input type="text" class="form-control" value="<?= $this->session->userdata['logged_in']['phone_number'] ?>" required>
											</div>
										</div>
									</div>
									<div class="mb-3">
										<label>Address</label>
										<input type="text" class="form-control" value="<?= $this->session->userdata['logged_in']['address'] ?>" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="text-center">
										<img src="<?= base_url()?>assets/img/avatars/<?= $this->session->userdata['logged_in']['photo'] ?>" class="rounded-circle img-responsive mt-2"
											width="128" height="128" />
										<div class="mt-2">
											<span class="btn btn-primary"><i class="fas fa-upload"></i> Upload</span>
										</div>
										<small>Max 1 MB</small>
									</div>
								</div>
							</div>

							<button type="submit" class="btn bg-stockism text-light btn-pill">Save</button>
						</form>

					</div>
				</div>

			</div>

			
			<div class="tab-pane fade" id="password" role="tabpanel">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Password</h5>

						<form>
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


